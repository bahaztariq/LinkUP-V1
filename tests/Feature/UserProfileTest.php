<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_public_profile()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->get(route('user.show', $user->id));

        $response->assertStatus(200);
        $response->assertViewIs('user.profile');
        $response->assertSee($user->name);
    }

    public function test_profile_displays_user_posts()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'user_id' => $user->id,
            'content' => 'My profile post content'
        ]);

        $response = $this->actingAs($user)->get(route('user.show', $user->id));

        $response->assertSee($post->content);
    }

    public function test_settings_page_is_accessible()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('profile.show'));

        $response->assertStatus(200);
        $response->assertViewIs('profile.show');
    }
}
