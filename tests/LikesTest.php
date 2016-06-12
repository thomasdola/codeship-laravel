<?php

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LikesTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function a_user_can_like_a_post()
    {
        //given
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();
        $this->be($user);

        //when
        $post->like();

        //then
        $this->seeInDatabase('likes', [
            'user_id' => $user->id,
            'likeable_id' => $post->id,
            'likeable_type' => get_class($post)
        ]);
    }

    /** @test */
    public function a_user_can_unlike_a_post()
    {
        //given
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();
        $this->be($user);
        $post->like();

        //when
        $post->unlike();

        //then
        $this->notSeeInDatabase('likes', [
            'user_id' => $user->id,
            'likeable_id' => $post->id,
            'likeable_type' => get_class($post)
        ]);
    }
}
