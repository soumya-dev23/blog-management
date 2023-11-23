<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;


class Comment extends Model
{

    use HasFactory;

    // To make sure that everything is fillable
    protected $guarded = [];

    // No timestamps while registering
    public $timestamps = false;

    // Relationship with users table
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


}
