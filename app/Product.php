<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    const PRODUCTO_DISPONIBLE = 'disponible';
    const PRODUCT_NO_DISPONIBLE = 'no disponible';

    protected $dates = ['deleted_at'];

    protected $fillable = [
      'name',
      'description',
      'quantity',
      'status',
      'image',
      'seller_id',
    ];
    public function estaDisponible()
    {
      return $this->status == Product::PRODUCTO_DISPONIBLE;
    }
    public function seller()
    {
      return $this->belongsTo(Seller::class);
    }
    public function transactions()
    {
      return $this->hasMany(Transaction::class);
    }

    public function categories()
    {
      return $this->belongsToMany(Category::class);
    }
     public function scopeSearch($query, $target){
        if( $target != ''){
            return $query
                ->where('products.description','LIKE','%'.$target.'%')
                ->orWhere('categories.name','LIKE','%'.$target.'%')
                ->orWhere(function($query) use ($target) {
                    return $query
                        ->where('sellers.email','LIKE','%'.$target.'%');
                });
        }

     }
     public function scopeCategoryId($query,$target){
        if ($target != ''){
            return $query->where(function($query)use($target){
                return $query->where('categories.id',$target);

            });
        }
     }


}
