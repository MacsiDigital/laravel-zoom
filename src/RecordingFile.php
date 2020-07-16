<?php

namespace MacsiDigital\Zoom;

use MacsiDigital\Zoom\Support\Model;

class RecordingFile extends Model
{
    public function recording()
    {
        return $this->belongsTo(Recording::class);
    }
}
