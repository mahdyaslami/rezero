<?php

namespace Tests\Feature;

use Tests\TestCase;

class OAuthTest extends TestCase
{
    public function test_redirect_to_github()
    {
        $this->get(route('github.redirect'))
            ->assertRedirect();
    }

    // TODO: I don't know how should i test this callback.
    // public function test_callback_from_github()
    // {
    //     //
    // }
}
