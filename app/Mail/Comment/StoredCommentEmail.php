<?php

namespace App\Mail\Comment;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StoredCommentEmail extends Mailable
{
    use Queueable, SerializesModels;
//    public $postUrl;
    /**
     * Create a new message instance.
     */
    public function __construct(private readonly Profile $profile, private readonly Comment $comment, private $postUrl)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'from laravel forest',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.comment.stored_comment',
            with: [
                'profile' => $this->profile,
                'comment' => $this->comment,
                'postUrl' => $this->postUrl,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
