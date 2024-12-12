<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{    
    /**
     * guarded
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];
     public $timestamps = true;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
