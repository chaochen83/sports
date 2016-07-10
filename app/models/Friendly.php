<?php

class Friendly extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'friendly';


    /**
     * Remove mass assignment protection
     * 
     * @var array
     */
    protected $guarded = [];

    public function scopeIsFriendly($query)
    {
        return $query->where('type', 'friendly');
    }

    public function scopeIsEducation($query)
    {
        return $query->where('type', 'education');
    }

    public function scopeNotDeleted($query)
    {
        return $query->where('status', '!=', 'deleted');
    }
}
