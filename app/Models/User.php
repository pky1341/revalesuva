<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\App;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'contact_number',
        'height',
        'initial_weight',
        'age',
        'profile_image',
        'gender',
        'regular_period',
        'date_of_last_period',
        'number_of_cycle_days',
        'street',
        'house',
        'apartment',
        'zipcode',
        'city',
        'personal_status',
        'occupation',
        'status',
        'last_login',
    ];

    protected $cast = [
        'name'=> 'string',
        'email'=> 'string',
        'password'=> 'hashed',
        'contact_number' => 'string',
        'height' => 'float',
        'initial_weight' => 'float',
        'age' => 'integer',
        'profile_image' => 'string',
        'gender' => 'string',
        'regular_period' => 'boolean',
        'date_of_last_period' => 'date',
        'number_of_cycle_days' => 'integer',
        'street' => 'string',
        'house' => 'string',
        'apartment' => 'string',
        'zipcode' => 'integer',
        'city' => 'string',
        'personal_status' => 'string',
        'occupation' => 'string',
        'status' => 'boolean',
        'last_login' => 'datetime',
    ];

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
    public function registerMailNotification(){
        $this->notify(new \App\Notifications\SendMailNotification($this));
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
}
