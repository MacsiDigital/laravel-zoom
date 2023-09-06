<?php

namespace MacsiDigital\Zoom\Requests;

use MacsiDigital\API\Support\PersistResource;

class StoreQuestionAnswer extends PersistResource
{
    protected $persistAttributes = [
        "enable" => "nullable|boolean",
        "allow_submit_questions" => "nullable|boolean",
        "allow_anonymous_questions" => "nullable|boolean",
        "answer_questions" => "nullable|string|in:only,all",
        "attendees_can_comment" => "nullable|boolean",
        "attendees_can_upvote" => "nullable|boolean",
        "allow_auto_reply" => "nullable|string",
        "auto_reply_text" => "nullable|boolean",
    ];
}
