<?php

class TrainingsAttendees extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'trainings_attendees';


    /**
     * Remove mass assignment protection
     * 
     * @var array
     */
    protected $guarded = [];
}
