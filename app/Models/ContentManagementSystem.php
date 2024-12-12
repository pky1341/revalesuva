<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentManagementSystem extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
    public $timestamps = true;
}
