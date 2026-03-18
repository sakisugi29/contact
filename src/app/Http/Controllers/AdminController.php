<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Contact;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::with('category');

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->keyword . '%')
                ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
                ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ['%' . $request->keyword . '%'])
                ->orWhere('email', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('created_at')) {
            $query->whereDate('created_at', $request->created_at);
        }

        $contacts = $query->paginate(7)->appends($request->query());

        return view('admin.index', compact('contacts'));
    }

    public function export()
    {
        $contacts = Contact::with('category')->get();

    $csvData = "ID,Name,Email,Gender,Category,Message,Created At\n";

    foreach ($contacts as $contact) {
        $csvData .= "{$contact->id},\"{$contact->name}\",\"{$contact->email}\",{$contact->gender},\"{$contact->category->content}\",\"{$contact->message}\",{$contact->created_at}\n";
    }

    return response($csvData)
        ->header('Content-Type', 'text/csv')
        ->header('Content-Disposition', 'attachment; filename=contacts.csv');

    }

    public function destroy(Contact $contact)
    {
    $contact->delete();
    return redirect()->route('admin.index');
    }

}

