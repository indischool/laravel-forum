<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfilesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function 사용자는_프로필_페이지를_가지고_있다()
    {
        $user = create('App\User', [
            'name' => 'John'
        ]);

        $this->get("/profiles/{$user->name}")
            ->assertSee($user->name);
    }

    /** @test */
    public function 프로필_페이지에는_사용자가_작성한_모든_스레드를_표시한다()
    {
        $this->signIn();

        $thread = create('App\Thread', [
            'user_id' => auth()->id()
        ]);

        $this->get("/profiles/" . urlencode(auth()->user()->name))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
