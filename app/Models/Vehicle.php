<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'license','brand','model','image','type','tags','year','color','doors'
    ];

    public $rules = [
        'license' => 'required|min:8|max:8',
        'brand' => 'required|min:2|max:20',
        'model' => 'required|min:2|max:20',
        'type' => 'required',
        'tags' => 'min:2|max:200',
        'year' => 'required|numeric|min:1700',
        'color' => 'required',
        'doors' => 'required|numeric'
    ];
    public $attributes = [
    ];
}
