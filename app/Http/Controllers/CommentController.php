<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', [
            'except' => ['index', 'show']
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $post = Post::query()->where('slug', $request->input('post'))->firstOrFail();
        $comments = $post->comments()->latest()->paginate();
        return CommentResource::collection($comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCommentRequest $request
     * @return CommentResource
     */
    public function store(StoreCommentRequest $request): CommentResource
    {
        $post = Post::query()->where('slug', $request->input('post'))->firstOrFail();
        return new CommentResource(
            $post->comments()->create($request->merge([
                'user_id' => $request->user()->id
            ])->toArray())
        );
    }

    /**
     * Display the specified resource.
     *
     * @param Comment $comment
     * @return CommentResource
     */
    public function show(Comment $comment): CommentResource
    {
        return new CommentResource($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Comment $comment
     * @param UpdateCommentRequest $request
     * @return CommentResource
     */
    public function update(Comment $comment, UpdateCommentRequest $request): CommentResource
    {
        $comment->update($request->all());
        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Comment $comment): JsonResponse
    {
        $comment->delete();
        return response()->json([
            'message' => __('crud.delete.success', [
                'attribute' => __('validation.attributes.comment')
            ])
        ]);
    }
}
