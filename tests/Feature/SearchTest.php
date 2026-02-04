<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_search_can_find_users()
    {
        $user = User::factory()->create(['name' => 'John Doe']);
        $otherUser = User::factory()->create(['name' => 'Jane Smith']);

        $response = $this->actingAs($user)->get(route('search', ['query' => 'John']));

        $response->assertStatus(200);
        $response->assertSee('John Doe');
        $response->assertDontSee('Jane Smith');
    }

    public function test_search_can_find_posts()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['content' => 'LinkUP is awesome']);
        $otherPost = Post::factory()->create(['content' => 'Another random post']);

        $response = $this->actingAs($user)->get(route('search', ['query' => 'LinkUP']));

        $response->assertStatus(200);
        $response->assertSee('LinkUP is awesome');
        $response->assertDontSee('Another random post');
    }
}
