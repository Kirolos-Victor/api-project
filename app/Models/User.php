<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates=['deleted_at'];
    protected $table='users';
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

    //seller
    public function products(){
        return  $this->hasMany(Product::class,'seller_id','id');
    }
    //buyer
    public function transactions(){
        return $this->hasMany(Transaction::class,'buyer_id','id');
    }
    //set name in database to lowercase
    public function setNameAttribute($value){
        $this->attributes['name']=strtolower($value);
    }
    // set email in database to lowercase
    public function setEmailAttribute($value){
        $this->attributes['email']=strtolower($value);
    }
    // get name from database as uppercase
    public function getNameAttribute($value){
        return ucwords($value);
    }
}
