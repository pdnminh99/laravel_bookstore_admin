<?php

namespace App\Models;

use App\View\Models\TabularRecord;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements TabularRecord, MustVerifyEmail
{
    use HasFactory, Notifiable;

//    public string $id;

    public string $user_name;

//    public string $email;

    public string $first_name;

    public string $last_name;

    public string $address;

    public string $city;

    public string $country;

    public string $about_me;

//    public function __construct(
//        string $id, string $user_name, string $email, string $first_name,
//        string $last_name, string $address,
//        string $city, string $country, string $about_me)
//    {
//        $this->id = $id;
//        $this->user_name = $user_name;
//        $this->email = $email;
//        $this->first_name = $first_name;
//        $this->last_name = $last_name;
//        $this->address = $address;
//        $this->city = $city;
//        $this->country = $country;
//        $this->about_me = $about_me;
//    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function get_fields()
    {
        // TODO: Implement get_fields() method.
    }

    public static function get_headers()
    {
        // TODO: Implement get_headers() method.
    }
}
