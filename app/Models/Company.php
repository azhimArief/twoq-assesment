<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'twoq.companies';

    protected $fillable = ['name', 'email', 'logo', 'website', 'created_at', 'updated_at'];
}
