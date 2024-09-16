<?php

namespace App\Exceptions;

use App\Models\Post;
use App\Models\Comment;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ExceptionFactory
{
    /**
     * @throws CategoryException
     * @throws PostException
     * @throws Exception
     */
    public static function create($model, string $method, int $code = 200)
    {
        $modelName = class_basename($model);

        if ($method === 'updateOrCreate') {
            $message = $model->wasRecentlyCreated ? "{$modelName} {$model->id} was created." : "{$modelName} {$model->id} was updated.";
        } else {
            $message = $model->wasRecentlyCreated ? "{$modelName} {$model->id} was created." : "{$modelName} {$model->id} already exists.";
        }

        Log::info("Method {$method} was called on {$modelName} with ID: {$model->id}. Recently created: " . ($model->wasRecentlyCreated ? 'Yes' : 'No'));

        switch ($modelName) {
            case 'Post':
                throw new PostException($model, $message, $code);

            case 'Category':
                throw  new CategoryException($model, $message, $code);

            default:
                throw  new Exception("Unsupported model: {$modelName}");
        }
    }
}
