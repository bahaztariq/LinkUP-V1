<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PostMediaTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_text_post()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('posts.store'), [
            'content' => 'This is a text only post',
        ]);

        $response->assertRedirect(route('dashboard'));

        $this->assertDatabaseHas('posts', [
            'content' => 'This is a text only post',
            'user_id' => $user->id,
            'image_path' => null,
            'video_path' => null,
        ]);
    }

    public function test_user_can_create_post_with_image()
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $file = UploadedFile::fake()->create('post-image.jpg', 100, 'image/jpeg');

        $response = $this->actingAs($user)->post(route('posts.store'), [
            'content' => 'Test post with image',
            'image' => $file,
        ]);

        $response->assertRedirect(route('dashboard'));

        $this->assertDatabaseHas('posts', [
            'content' => 'Test post with image',
            'user_id' => $user->id,
        ]);

        $post = \App\Models\Post::first();
        $this->assertNotNull($post->image_path);
        Storage::disk('public')->assertExists($post->image_path);
    }

    public function test_user_can_create_post_with_video()
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $file = UploadedFile::fake()->create('post-video.mp4', 1000, 'video/mp4');

        $response = $this->actingAs($user)->post(route('posts.store'), [
            'content' => 'Test post with video',
            'video' => $file,
        ]);

        $response->assertRedirect(route('dashboard'));

        $this->assertDatabaseHas('posts', [
            'content' => 'Test post with video',
            'user_id' => $user->id,
        ]);

        $post = \App\Models\Post::first();
        $this->assertNotNull($post->video_path);
        Storage::disk('public')->assertExists($post->video_path);
    }

    public function test_post_media_validation()
    {
        $user = User::factory()->create();

        // Test invalid image type
        $response = $this->actingAs($user)->post(route('posts.store'), [
            'content' => 'Invalid image',
            'image' => UploadedFile::fake()->create('document.pdf', 100),
        ]);
        $response->assertSessionHasErrors('image');

        // Test invalid video type
        $response = $this->actingAs($user)->post(route('posts.store'), [
            'content' => 'Invalid video',
            'video' => UploadedFile::fake()->create('document.pdf', 100),
        ]);
        $response->assertSessionHasErrors('video');
    }
}
