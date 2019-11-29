<?php

namespace App\Mail;

use App\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostUpdated extends Mailable {
  use Queueable, SerializesModels;

  public $post;

  public function __construct(Post $post) {

    $this->post = $post;
  }


  public function build() {

    return $this->from('Liube@gmail.com')
        ->view('emails.postUpdated');
  }
}
