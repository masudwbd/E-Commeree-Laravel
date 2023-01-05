<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\ChildCategory;
use App\Models\Brand;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id','subcategory_id','childcategory_id','brand_id','name','code','color','size','unit','tags','video','purchase_price','selling_price','discount_price','stock_quantity','warehouse','description','thumbnail','images','featured','today_deal','status','flash_deal_id','pickup_points_id','cash_on_delivery','admin_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function subcategory(){
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }
    public function Childcategory(){
        return $this->belongsTo(ChildCategory::class, 'childcategory_id');
    }
    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function pickup_point(){
        return $this->belongsTo(Pickup_Point::class, 'pickup_point_id');
    }
}
