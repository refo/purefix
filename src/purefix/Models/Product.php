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
        'vendor' => 'purefix',
        'collection' => '',
        'price'   => 0,
        'price_currency' => null,
        'image'   => null,
        'images'  => null, //JSON
        'images_extra' => null, // JSON
        'description' => null,
        'description_extra' => null,
        'product_type' => null,
        'template' => null,
        'options' => null, // JSON
    ];

    //protected $fillable   = [];

    protected $guarded = ['id'];

    protected $appends = ['url', 'hprice'];
    
    public $timestamps = true;

    // ===================================================
    // MODEL ATTRIBUTES
    // ===================================================

    protected $routeName = 'product';

    protected $currencyFormat = [
        'TRY' => '%d TL',
        'USD' => '$ %d',
    ];

    // ===================================================
    // RELATIONSHIPS
    // ===================================================

    public function variants()
    {
        return $this->hasMany('Purefix\Models\ProductVariant');
    }

    // ===================================================
    // QUERY SCOPES
    // ===================================================
    
    public function scopePublished($query)
    {
        $query->where('active', 1);
    }

    public function scopeOnlyListingFields($query)
    {
        $query->select(
            'id',
            'slug',
            'title',
            'collection',
            'image',
            'price',
            'price_currency'
        );
    }

    public function scopeGetGroupedByCollection($query)
    {
        return $query
            ->onlyListingFields()
            ->get()
            // Collection
            ->groupBy('collection')
            ->map(function($group, $title){
                return collect([
                    'title' => $title,
                    'list' => $group,
                ]);
            });
    }


    // ===================================================
    // ACCESSORS & MUTATORS
    // ===================================================
    
    /**
     * hprice - Human readable representation of the price
     * @return String Depending on price currency and format
     * returns a human readable price label "20 TL", "$ 20", etc.
     */
    public function getHpriceAttribute()
    {
        return sprintf(
            array_get($this->currencyFormat, $this->attributes['price_currency'], '%d'),
            $this->attributes['price']
        );
    }

    public function getUrlAttribute()
    {
        return route($this->routeName, $this->attributes['slug']);
    }
    
    public function setImagesAttribute($value)
    {
        $this->attributes['images'] = json_encode((array)$value);
    }

    public function getImagesAttribute($value)
    {
        return json_decode($value, TRUE);
    }

    public function setImagesExtraAttribute($value)
    {
        $this->attributes['images_extra'] = json_encode((array)$value);
    }

    public function getImagesExtraAttribute($value)
    {
        return json_decode($value, TRUE);
    }

    public function setOptionsAttribute($value)
    {
        $this->attributes['options'] = json_encode((array)$value);
    }

    public function getOptionsAttribute($value)
    {
        return json_decode($value, TRUE);
    }



}

