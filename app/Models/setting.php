<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class setting extends Model
{
    protected $fillable = [
        'currency',
        'phone_one',
        'phone_two',
        'main_email',
        'support_email',
        'logo',
        'address',
        'facebook',
        'twitter',
        'instagram',
        'linkdin',
        'youtube',
    ];
}
