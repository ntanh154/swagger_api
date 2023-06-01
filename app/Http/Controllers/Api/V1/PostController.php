<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Create Post
     * @OA\Post (
     *     path="/api/v1/post/store",
     *     tags={"Post"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="title",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="description",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "name":"example name",
     *                     "title":"example title",
     *                     "description":"example description"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="name", type="string", example="name"),
     *              @OA\Property(property="title", type="string", example="title"),
     *              @OA\Property(property="description", type="string", example="description"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="invalid",
     *          @OA\JsonContent(
     *              @OA\Property(property="msg", type="string", example="fail"),
     *          )
     *      )
     * )
     */
    public function store(Request $request) {
        $post = $this->post->createPost($request->all());
        return response()->json($post);
    }


    /**
     * Get Detail post
     * @OA\Get (
     *     path="/api/v1/post/get/{id}",
     *     tags={"Post"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="name", type="string", example="name"),
     *              @OA\Property(property="title", type="string", example="title"),
     *              @OA\Property(property="description", type="string", example="description"),
     *         )
     *     )
     * )
     */
    public function get($id){
        $post = $this->post->getPost($id);
        if($post){
            return response()->json($post);
        }
        return response()->json(["msg"=>"Todo item not found"],404);
    }


    /**
     * Update Post
     * @OA\Put (
     *     path="/api/v1/post/update/{id}",
     *     tags={"Post"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="title",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="description",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "name":"example name",
     *                     "title":"example title",
     *                     "description":"example description"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="name", type="string", example="name"),
     *              @OA\Property(property="title", type="string", example="title"),
     *              @OA\Property(property="description", type="string", example="description"),
     *          )
     *      )
     * )
     */
    public function update($id, Request $request){
        try {
            $post = $this->post->updatePost($id,$request->all());
            return response()->json($post);
        }catch (\Throwable $exception){
            return response()->json(["msg"=>$exception->getMessage()],404);
        }
        
    }


    /**
     * Delete Post
     * @OA\Delete (
     *     path="/api/v1/post/delete/{id}",
     *     tags={"Post"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *             @OA\Property(property="msg", type="string", example="delete todo success")
     *         )
     *     )
     * )
     */
    public function delete($id){
        try {
            $post = $this->post->deletePost($id);
            return response()->json(["msg"=>"delete post success"]);
        }catch (\Throwable $exception){
            return response()->json(["msg"=>$exception->getMessage()],404);
        }
    }

    /**
     * Get List Post
     * @OA\Get (
     *     path="/api/v1/post/gets",
     *     tags={"Post"},
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="_id",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="example name"
     *                     ),
     *                     @OA\Property(
     *                         property="title",
     *                         type="string",
     *                         example="example title"
     *                     ),
     *                      @OA\Property(
     *                         property="description",
     *                         type="string",
     *                         example="example description"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         example="2021-12-11T09:25:53.000000Z"
     *                     ),
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         example="2021-12-11T09:25:53.000000Z"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function gets(){
        $posts = $this->post->getsPost();
        return response()->json(["rows"=>$posts]);
    }  
}
