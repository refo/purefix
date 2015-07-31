<?php

namespace Purefix\Models;

class Product extends Model {

    // ===================================================
    // ELOQUENT ATTRIBUTES
    // ===================================================

    //protected $table      = '';
    protected $attributes = [
        'active'   => 1,
        'category' => 1,
        'slug'   => null,
        'title'  => '',
        'body'   => '',
        'vendor' => 'purefix',
        'collection' => '',
        'price'   => 0,
        'image'   => '',
        'images'  => '',
        'images_extra' => '',
        'product_type' => '',
        'template' => '',
        'options' => '',
    ];

    protected $fillable   = [];
    protected $appends    = ['variants'];
    
    public $timestamps    = true;


    // ===================================================
    // RELATIONSHIPS
    // ===================================================

    public function variants()
    {
        return $this->hasMany('Purefix\Models\ProductVariant');
    }

}
