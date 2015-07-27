<?php

namespace Purefix\Models;

class Transaction extends Model {

    // ===================================================
    // ELOQUENT ATTRIBUTES
    // ===================================================
    
    //protected $table      = '';
    protected $attributes = [];
    protected $fillable   = [];
    protected $appends    = [];
    
    public $timestamps    = true;


    // ===================================================
    // RELATIONSHIPS
    // ===================================================

    public function order()
    {
        return $this->belongsTo('Order');
    }

}
