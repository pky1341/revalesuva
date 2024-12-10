<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeforePicture extends Model
{
    protected $table = "before_pictures";

    protected $fillable = [
        "user_id",
        "back_pic",
        "side_pic",
        "front_pic",
    ];
}
