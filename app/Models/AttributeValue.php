<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class AttributeValue extends Model
{
    use HasFactory;
    use SoftDeletes;

    CONST ATTRIBUTE_SIZE = 1;
    CONST ATTRIBUTE_COLOR = 2;
    protected $table = "attribute_values";
    protected $fillable = [
        'attribute_id',
        'name'
    ];

    public function getNameAttribute($name)
    {
        return Str::ucfirst($name);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'attribute_product', 'attribute_value_id', 'product_id');
    }
}
