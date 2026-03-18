<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail'
    ];

    public static $rules = [
        'category_id' => 'required',
        'first_name' => 'required|max:8',
        'last_name' => 'required|max:8',
        'gender' => 'required',
        'email' => 'required|email',
        'tel' => 'required|digits_between:1,5',
        'address' => 'required',
        'building' => 'nullable',
        'detail' => 'required|max:120'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }



}
