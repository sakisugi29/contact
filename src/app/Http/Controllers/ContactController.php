<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    public function index()
    {
        $categories = \App\Models\Category::all();
        return view('contact.index', ['categories' => $categories]);
    }

    public function confirm(ContactRequest $request)
    {
        $inputs = $request->only([
            'category_id',
            'first_name',
            'last_name',
            'gender',
            'email',
            'tel1',
            'tel2',
            'tel3',
            'address',
            'building',
            'detail',
        ]);
        $genderLabels = [
            '0' => '男性',
            '1' => '女性',
            '2' => 'その他'
        ];
        $genderLabel=$genderLabels[$inputs['gender']] ?? '';
        $tel =$request->tel1 . '-' . $request->tel2 . '-' . $request->tel3;
        $inputs['tel'] = $tel;
        $category = Category::find($inputs['category_id']);
        return view('contact.confirm', ['inputs' => $inputs, 'category' => $category, 'genderLabel' => $genderLabel]);
    }

    public function store(ContactRequest $request)
    {
        if($request->action === 'back'){
            return redirect('/')->withInput();
        }
        $inputs=$request->validated();
        $inputs['tel'] = $inputs['tel1'] . '-' . $inputs['tel2'] . '-' . $inputs['tel3'];
        unset($inputs['tel1'], $inputs['tel2'], $inputs['tel3']);
        Contact::create($inputs);
        return redirect('/thanks');
    }

    public function thanks()
    {
        return view('contact.thanks');
    }
}