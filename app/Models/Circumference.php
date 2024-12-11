<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Circumference extends Model
{
    protected $table = 'circumference';
    protected $fillable = ["user_id", "chest", "waist", "hip"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
