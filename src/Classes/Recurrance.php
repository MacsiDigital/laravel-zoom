<?php 
namespace MacsiDigital\Zoom\Classes;

class Recurrance extends Model
{

	protected $attributes = [
        "type" => '', // integer
        "repeat_interval" => '', // integer
        "weekly_days" => '', // integer
        "monthly_day" => '', // integer
        "monthly_week" => '', // integer
        "monthly_week_day" => '', // integer
        "end_times" => '', // integer
        "end_date_time" => '', // string [date-time]
    ];

}