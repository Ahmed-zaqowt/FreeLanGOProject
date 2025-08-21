<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory , HasRoles , HasUlids;
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id'
    ];

    protected $guard_name = 'admin';


    public function images() {
       return $this->morphOne(Image::class , 'imageable'); // id , type
    }



}
