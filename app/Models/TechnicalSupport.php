<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechnicalSupport extends Model
{
    protected $table = "technical_support";
    protected $fillable = [
        "user_id",
        "help_question",
        "help_details",
        "status",
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
}
