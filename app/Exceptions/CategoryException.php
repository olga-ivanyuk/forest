<?php

namespace App\Exceptions;

use App\Models\Category;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CategoryException extends Exception
{
    public function __construct(private readonly Category $category, string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function report(): void
    {
        Log::channel('categories')->info($this->message, ['category_id' => $this->category->id]);
    }

    public function render(Request $request): Response
    {
        return response([
            'message' => $this->message,
            'category_id' => $this->category->id,
        ], $this->code);
    }

    /**
     * @throws CategoryException
     */
    public static function checkIfCategoryExists(Category $category)
    {
        if (!$category->wasRecentlyCreated) {
            throw new self($category, "Category {$category->id} already exists.", Response::HTTP_OK);
        }
    }
}
