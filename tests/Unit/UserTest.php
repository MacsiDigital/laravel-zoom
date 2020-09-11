<?php

namespace MacsiDigital\Zoom\Test;

class UserTest extends TestCase
{
    /** @test */
    public function all_users_can_be_listed()
    {
        $user = Zoom::user()->all();

        $this->assertNotNull($user);
    }
}
