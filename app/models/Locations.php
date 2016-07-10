<?php

class Locations extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'locations';


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
