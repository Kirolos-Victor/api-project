<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    Const AVAILABLE_PRODUCT='available';
    Const UNAVAILABLE_PRODUCT='unavailable';
    protected $dates=['deleted_at'];
    public $timestamps=true;
    protected $fillable=[
        'name',
        'description',
        'quantity',
        'status',
        'image',
        'seller_id',
        'category_id'
    ];
    public function isAvailable(){
        return $this->status == self::AVAILABLE_PRODUCT;
    }
    public function seller(){
       return $this->belongsTo(User::class,'seller_id','id');
    }
    public function transactions(){
        return $this->hasMany(Transaction::class,'product_id','id');
    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

}
