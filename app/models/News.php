<?php

class News extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'news';


    /**
     * Remove mass assignment protection
     * 
     * @var array
     */
    protected $guarded = [];


    public function scopeNotDeleted($query)
    {
        return $query->where('status', '!=', 'deleted');
    }
}
