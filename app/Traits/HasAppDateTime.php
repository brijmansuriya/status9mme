<?php

namespace App\Traits;

use DateTimeInterface;

trait HasAppDateTime
{

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format(config('app.default_date_format'));
    }
}
