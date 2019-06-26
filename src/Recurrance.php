<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class Recurrance extends Model
{
    const KEY_FIELD = 'type';

    protected $attributes = [
        'type' => '', // integer
        'repeat_interval' => '', // integer
        'weekly_days' => '', // integer
        'monthly_day' => '', // integer
        'monthly_week' => '', // integer
        'monthly_week_day' => '', // integer
        'end_times' => '', // integer
        'end_date_time' => '', // string [date-time]
    ];

    protected $createAttributes = [
        'type',
        'repeat_interval',
        'weekly_days',
        'monthly_day',
        'monthly_week',
        'monthly_week_day',
        'end_times',
        'end_date_time',
    ];

    protected $updateAttributes = [
        'type',
        'repeat_interval',
        'weekly_days',
        'monthly_day',
        'monthly_week',
        'monthly_week_day',
        'end_times',
        'end_date_time',
    ];
}
