<?php

namespace Purefix\Models;

class Order extends Model {

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

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function transactions()
    {
        return $this->hasMany('Transaction');
    }

}
