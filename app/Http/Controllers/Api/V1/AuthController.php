<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CreateUserRequest;
use App\Http\Resources\AuthResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register User
     * 
     * @OA\Post(
     *      path="/api/v1/register",
     *      tags={"Auth"},
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              ref="#/components/schemas/CreateUserRequest"
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/AuthResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     * @param CreateUserRequest $request
     * @return AuthResource 
     */

     
    public function createUser(CreateUserRequest $request): AuthResource
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return new AuthResource($user);
    }

    
}
