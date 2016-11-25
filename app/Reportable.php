<?php

namespace App;

trait Reportable
{
    /**
     * Get all of the model's reports.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }
}
