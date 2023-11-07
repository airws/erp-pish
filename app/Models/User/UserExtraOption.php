<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExtraOption extends Model
{
    protected $dates = [
        'date_of_issue',
        'date_of_issue_of_the_education_document',
    ];


    use HasFactory;
}
