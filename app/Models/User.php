<?php

namespace App\Models;

use App\View\Models\TabularField;
use App\View\Models\TabularRecord;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements TabularRecord, MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;

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
        'name' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'city' => 'string',
        'email_verified_at' => 'datetime',
    ];

    public function books()
    {
        return $this->hasMany('App\Models\Book');
    }

    public function get_fields()
    {
        return [
            TabularField::parse_text($this->name, null, "users/$this->id"),
            TabularField::parse_text($this->email),
            TabularField::parse_status($this->getRoleNames()[0]),
            TabularField::new_actions_builder('users')
                ->add_action('details', "users/$this->id")
                ->build()
        ];
    }

    public static function get_headers()
    {
        return ['name', 'email', 'role', ''];
    }
}
