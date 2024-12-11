<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InquiryService extends Model
{
    protected $table = "inquiry_service";
    protected $fillable = [
        "user_id",
        "help_question",
        "help_details",
        "status",
    ];
}
