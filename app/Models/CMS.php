<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CMS extends Model
{
    protected $table = "content_management_system";
    protected $fillable = [
        "title",
        "slug",
        "description",
        "status",
    ];
}
