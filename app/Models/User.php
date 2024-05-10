<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    // laravel permissionを使うための記述↓
     use Notifiable,HasRoles;
     use HasApiTokens, HasFactory, Notifiable;
     
// public function roles(): BelongsToMany
//     {
//         return $this->belongsToMany(Person::class,'user_roles', 'user_id', 'role_id')
//         ->withTimestamps();
//     }    
    
public function people_family(): BelongsToMany
    {
        return $this->belongsToMany(Person::class, 'people_families', 'user_id', 'person_id')
        ->withTimestamps();
    }
    
    // FacilityとUserを紐づけた中間テーブルを取ってくる↓
    public function facility_staffs(): BelongsToMany
    {
  //↓ belongsToMany('多対多の相手側のクラス名…ClassName::class','中間テーブルの名前',　'このモデルを参照する中間テーブルの外部キー名', '相手側のモデルを参照する中間テーブルの外部キー名')
    return $this->belongsToMany(Facility::class, 'facility_staffs', 'staff_id','facility_id')
    ->withTimestamps();
    
    }
    
   
    public function user_roles(): BelongsToMany
    {
  //↓ belongsToMany('多対多の相手側のクラス名…ClassName::class','中間テーブルの名前',　'このモデルを参照する中間テーブルの外部キー名', '相手側のモデルを参照する中間テーブルの外部キー名')
    return $this->belongsToMany(Role::class, 'user_roles', 'user_id','role_id')
    ->withTimestamps();
    
    }
    
    public function temperatures()
    {
        return $this->hasMany(Temperature::class,'user_id');
    }
    
   

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        // 'role',
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
    ];
    
    
}