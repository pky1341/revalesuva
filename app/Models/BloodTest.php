<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodTest extends Model
{
    protected $table = "blood_test";

    protected $fillable = [
        "user_id","blood_test_report"
        ];
}
