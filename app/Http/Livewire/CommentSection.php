<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class CommentSection extends Component
{
    public $post;
    public $successMessage;

    // public function mount(Post $post)
    // {
    //     $this->post = $post;
    // }

    public function render()
    {
        return view('livewire.comment-section');
    }
}
