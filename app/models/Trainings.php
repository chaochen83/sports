<?php

class Trainings extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'trainings';


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

    public function scopeNotOver($query)
    {
        return $query->where('date', '>=', date('Y-m-d'));
    }    
}
