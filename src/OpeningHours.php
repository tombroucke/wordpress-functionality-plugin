<?php

namespace FunctionalityPlugin;

class OpeningHours
{
    public function schedule()
    {
        $schedule = collect();
        $weekdays = app()->make('functionality_plugin.locale');
        $weekdays->weekDays()->each(function ($day, $key) use ($schedule) {
            $openingHours = array_filter((array)get_field('opening_hours_' . $key, 'option'));
            $schedule->push([
                'day' => $day,
                'hours' => $openingHours,
            ]);
        });
        return $schedule;
    }
}
