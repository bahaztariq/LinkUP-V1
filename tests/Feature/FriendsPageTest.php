<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Friendship;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FriendsPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_friends_page_loads()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('friends.index'));

        $response->assertStatus(200);
        $response->assertSee('Friends');
        $response->assertSee('All Friends');
    }

    public function test_friends_page_shows_requests()
    {
        $user = User::factory()->create();
        $requester = User::factory()->create(['name' => 'John Requester']);

        Friendship::create([
            'requester_id' => $requester->id,
            'addressee_id' => $user->id,
            'status' => 'pending',
        ]);

        $response = $this->actingAs($user)->get(route('friends.index'));

        $response->assertStatus(200);
        $response->assertSee('John Requester');
        $response->assertSee('Confirm');
        $response->assertSee('Delete');
    }

    public function test_friends_page_shows_accepted_friends()
    {
        $user = User::factory()->create();
        $friend = User::factory()->create(['name' => 'Jane Friend']);

        $user->friendshipsSent()->create([
            'addressee_id' => $friend->id,
            'status' => 'accepted',
        ]);

        $response = $this->actingAs($user)->get(route('friends.index'));

        $response->assertStatus(200);
        $response->assertSee('Jane Friend');
    }
}
