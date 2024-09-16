<?php

namespace App\Exceptions;

use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class PostException extends Exception
{
    public function __construct(private readonly Post $post, string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function report(): void
    {
        Log::channel('posts')->info($this->message, ['post_id' => $this->post->id]);
    }

    public function render(Request $request): Response
    {
        return response([
            'message' => $this->message,
            'post_id' => $this->post->id,
        ], $this->code);
    }

    /**
     * @throws PostException
     */
    public static function checkIfPostExists(Post $post)
    {
        if (!$post->wasRecentlyCreated) {
            throw new self($post, "Post {$post->id} already exists.", Response::HTTP_OK);
        }
    }
}
