<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkin extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'equipment_id', 'checkin', 'checkout'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'checkin', 'checkout'
    ];

    /**
     * Returns the calories per minute for this checkin
     *
     * @param int $calories Calories per minute
     * @return float Calories burned
     */
    public function burned($calories)
    {
        if (!$this->checkin || !$this->checkout) {
            return 0.0;
        }
        $minDiff = $this->checkin->diffInMinutes($this->checkout);
        $secDiff = $this->checkin->diffInSeconds($this->checkout) % 60;
        $burned = $minDiff * $calories;
        if ($secDiff > 0) {
            $burned += ($secDiff / 60) * $calories;
        }
        return $burned;
    }
}
