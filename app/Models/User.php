<?php
  namespace App\Models;
  use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Illuminate\Foundation\Auth\User as Authenticatable;
  use Illuminate\Notifications\Notifiable;
  use Laravel\Sanctum\HasApiTokens;
  use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
      'name',
      'username',
      'email',
      'password',
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
* The attributes that should be cast.
*
* @var array<string, string>
*/
  protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
  ];
  public static function adminlte_image()
  {
      $base = 'storage/images/';
      return auth()->user()->profile_photo_url == null ? 'https://picsum.photos/300/300' : $base.auth()->user()->profile_photo_url;
  }
  public static function adminlte_desc()
  {
      return auth()->user()->username == null ? '' : auth()->user()->username;
  }
  public static function adminlte_profile_url()
  {
      return 'dashboard/profile';
  }
}
