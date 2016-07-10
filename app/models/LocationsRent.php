<?php

class LocationsRent extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'locations_rent';


    /**
     * Remove mass assignment protection
     * 
     * @var array
     */
    protected $guarded = [];


    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}
