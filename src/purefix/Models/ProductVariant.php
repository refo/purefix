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
    ];
    protected $fillable   = [];
    protected $appends    = [];
    
    public $timestamps    = true;


    // ===================================================
    // RELATIONSHIPS
    // ===================================================

    public function product()
    {
        return $this->belongsTo('Product');
    }

}
