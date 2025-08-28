<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory , HasUlids , SoftDeletes;

    protected $guarded = [] ;

    function proposals() {
        return $this->hasMany(Proposal::class);
    }

    function user() {
       return $this->belongsTo(User::class);
    }
}
