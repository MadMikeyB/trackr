<?php

namespace App;

use App\Primitives\Money;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSetting extends Model
{
    use SoftDeletes;
    
    /* @var array $fillable The fields which are mass assignable in the database */
    protected $fillable = ['user_id', 'hourly_rate', 'currency'];

    /**
     * Set the hourly rate attribute
     *
     * @param string $hourlyRate
     */
    public function setHourlyRateAttribute($hourlyRate)
    {
        $money = Money::fromPounds($hourlyRate);
        if (env('APP_ENV') !== 'testing') {
            $this->attributes['hourly_rate'] = $money->inPence();
        }
    }

    /**
     * Get the hourly rate attribute
     *
     * @param string $hourlyRate
     * @return string
     */
    public function getHourlyRateAttribute($hourlyRate)
    {
        $money = Money::fromPence($hourlyRate);
        if (env('APP_ENV') !== 'testing') {
            return $money->inPoundsAndPence();
        }
    }
}
