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

    // ===================================================
    // GETTER QUERY SCOPES
    // These are return 'processed collections'
    // unlike query scopes should return modified queries.
    // ===================================================
    
    public function scopeGetDetail($query, $slug)
    {
        $product = $query
            ->with('variants')
            ->where('slug', $slug)
            ->first();

        $product->variants->map(function($variant){
            static $setActive = true;
            $variant->cssClass = '';
            
            if ($setActive AND $variant->inventory > 0) {
                $variant->cssClass = 'active';
                $setActive = false;
            }
            if (!$variant->inventory) {
                $variant->disabled = 'disabled';
                $variant->cssClass .= ' disabled';
            }
            return $variant;
        });

        return $product;
    }
    
    public function scopeGetGroupedByCollection($query)
    {
        $grouped = $query
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

        // Array with group keys and empty values
        // to fill from unsorted array fetched
        // 
        // TODO: (this a temporary solution obviously)
        // Create a Category model with hasMany relationship with itself or
        // both a Category (for general purposes) and Collection model (solely for grouping products)
        
        $arr = [
            'PUREFIX-ORIGINAL'     => NULL,
            'PUREFIX-GLOW'         => NULL,
            'PUREFIX-PREMIUM'      => NULL,
            'PURECITY-STEPTHROUGH' => NULL,
            'PURECITY-CLASSIC'     => NULL,
        ];

        foreach($arr as $k => $v) {
            $arr[$k] = $grouped[$k];
        }

        return collect($arr);
    }

    public function scopeGetByCollection($query, $collection)
    {
        // Lazyless at its best
        // TODO: this whole method is copy-pasted "list all products by collection"
        // method modified.
        // collections or categories for grouping matter, should be a model itself
        // and be in a "one to many" relation with products.
        // 

        $grouped = $query
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

            $collection = strtoupper($collection);
            return $grouped[$collection];
    }

    // ===================================================
    // ACCESSORS & MUTATORS
    // ===================================================
    
    public function getDescriptionAttribute($value)
    {
        return nl2br($value);
    }

    public function getDescriptionExtraAttribute($value)
    {
        return nl2br($value);
    }
    
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

