<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
     protected $guarded = ['id', 'created_at', 'updated_at'];
     public $timestamps = true;
    protected $casts = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
   
    public function weights()
    {
        return $this->hasMany(Weight::class);
    }

    public function circumferences()
    {
        return $this->hasMany(Circumference::class);
    }

    public function bloodTests()
    {
        return $this->hasMany(BloodTest::class);
    }

    public function beforePictures()
    {
        return $this->hasMany(BeforePicture::class);
    }
    public function technicalsupport()
    {
        return $this->hasMany(BloodTest::class);
    }

    public function inquiryservice()
    {
        return $this->hasMany(BeforePicture::class);
    }
} 
