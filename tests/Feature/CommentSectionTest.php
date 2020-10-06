<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use Livewire\Livewire;
use App\Http\Livewire\CommentSection;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentSectionTest extends TestCase
{
    use RefreshDatabase;
        /** @test */
        public function post_page_contains_comment_component()
        {
            $post = Post::Create([
                'title' => 'first post',
                'content' => 'post content'
            ]);

            $this->get(route('post.show', $post))
                ->assertSeeLivewire('comment-section');
        }

        /** @test */
        public function valid_comments_can_be_created()
        {
            $post = Post::Create([
                'title' => 'first post',
                'content' => 'post content'
            ]);

            Livewire::test(CommentSection::class)
                ->set('post', $post)
                ->set('comment', 'This is a comment')
                ->call('createComment')
                ->assertSee('Comment posted!')
                ->assertSee('This is a comment');
        }

        /** @test */
        public function invalid_comments_cannot_be_created()
        {
            $post = Post::Create([
                'title' => 'first post',
                'content' => 'post content'
            ]);

            Livewire::test(CommentSection::class)
                ->set('post', $post)
                ->call('createComment')
                ->assertHasErrors(['comment' => 'required'])
                ->assertSee('The comment field is required');
        }

        /** @test */
        public function comment_required_four_chars()
        {
            $post = Post::Create([
                'title' => 'first post',
                'content' => 'post content'
            ]);

            Livewire::test(CommentSection::class)
                ->set('post', $post)
                ->set('comment', 'abc')
                ->call('createComment')
                ->assertHasErrors(['comment' => 'min'])
                ->assertSee('The comment must be at least 4 characters.');
        }
}
