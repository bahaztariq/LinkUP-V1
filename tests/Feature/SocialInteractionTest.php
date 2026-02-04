<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SocialInteractionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_send_friend_request()
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();

        $this->actingAs($userA)->post(route('friendships.store'), [
            'addressee_id' => $userB->id
        ]);

        $this->assertDatabaseHas('friendships', [
            'requester_id' => $userA->id,
            'addressee_id' => $userB->id,
            'status' => 'pending'
        ]);
    }

    public function test_user_can_accept_friend_request()
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();

        $friendship = $userA->friendshipsSent()->create([
            'addressee_id' => $userB->id,
            'status' => 'pending'
        ]);

        $this->actingAs($userB)->patch(route('friendships.update', $friendship->id));

        $this->assertDatabaseHas('friendships', [
            'id' => $friendship->id,
            'status' => 'accepted'
        ]);
    }

    public function test_user_can_reply_to_comment()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();
        $comment = Comment::factory()->create([
            'commentable_id' => $post->id,
            'commentable_type' => get_class($post)
        ]);

        $this->actingAs($user)->post(route('comments.store'), [
            'body' => 'This is a reply',
            'commentable_id' => $post->id,
            'commentable_type' => get_class($post),
            'parent_id' => $comment->id
        ]);

        $this->assertDatabaseHas('comments', [
            'body' => 'This is a reply',
            'parent_id' => $comment->id
        ]);
    }

    public function test_user_can_like_comment()
    {
        $user = User::factory()->create();
        $comment = Comment::factory()->create();

        $this->actingAs($user)->post(route('reactions.toggle'), [
            'reactable_id' => $comment->id,
            'reactable_type' => get_class($comment),
            'type' => 'like'
        ]);

        $this->assertDatabaseHas('reactions', [
            'user_id' => $user->id,
            'reactable_id' => $comment->id,
            'reactable_type' => get_class($comment),
            'type' => 'like'
        ]);
    }
}
