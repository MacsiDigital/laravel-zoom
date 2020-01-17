<?php

namespace MacsiDigital\Zoom;

class UserSettings
{
    public static function getWebinarSettings(bool $webinarSetting = true): array
    {
        return [
            'feature' => [
                'webinar' => $webinarSetting,
            ],
        ];
    }
}
