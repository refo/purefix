<?php

namespace Purefix\Models;

class ProductVariant extends Model {

    // ===================================================
    // ELOQUENT ATTRIBUTES
    // ===================================================
    
    //protected $table      = '';
    protected $attributes = [
        'active' => 1,
        'title' => '',
        'inventory' => 0,
        'sales' => 0,
        'price' => null,
        'price_currency' => null,
    ];
    protected $fillable   = ['title', 'url_n11'];
    protected $appends    = [];
    
    public $timestamps    = true;


    // ===================================================
    // RELATIONSHIPS
    // ===================================================

    public function product()
    {
        return $this->belongsTo('Purefix\Models\Product');
    }

}
