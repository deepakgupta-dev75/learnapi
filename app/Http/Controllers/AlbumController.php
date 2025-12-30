<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AlbumController extends Controller
{
    //
    /**
    *  @OA\Get(
    *     path="/albums",
    *     tags={"Albums"},
    *     summary="Get list of Albums",
    *     description="Get paginated list of Albums with search, filter, and sorting options.",
    *     security={{"BearerAuth":{}}},
    *
    *     @OA\Parameter(name="page", in="query", description="Page No", @OA\Schema(type="integer", example=1)),
    *     @OA\Parameter(name="per_page", in="query", description="Per Page", @OA\Schema(type="integer", example=10)),
    *     @OA\Parameter(name="search", in="query", description="Searching", @OA\Schema(type="string", example="John")),
    *     @OA\Parameter(name="filter_status", in="query", description="Filter Status", @OA\Schema(type="string", example="active")),
    *     @OA\Parameter(name="sort_by", in="query", description="Sort By", @OA\Schema(type="string", example="name")),
    *     @OA\Parameter(name="sort_order", in="query", description="Sort Order", @OA\Schema(type="string", example="asc")),
    *
    *     @OA\Response(
    *         response=200,
    *         description="Successful operation",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="data", type="array",
    *                 @OA\Items(type="object",
    *                     @OA\Property(property="id", type="integer", example=1),
    *                     @OA\Property(property="name", type="string", example="John Doe"),
    *                     @OA\Property(property="email", type="string", example="john@example.com"),
    *                     @OA\Property(property="status", type="string", example="active")
    *                 )
    *             )
    *         )
    *     )
    * )
    */

    public function index()
    {
        return response()->json(['user1', 'user2']);
    }

    /**
     * @OA\Post(
     *     path="/albums",
     *     tags={"Albums"},
     *     summary="Create a user",
     *     description="Creates a new user in the system",
     *     security={{"BearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"name", "email"},
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="john@example.com")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="User created")
     *         )
     *     ),
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function store(Request $request)
    {
        return response()->json(['message' => 'User created'], 201);
    }

    /**
     * @OA\Put(
     *     path="/albums/{id}",
     *     tags={"Albums"},
     *     summary="Update a user",
     *     description="Updates an existing user's details",
     *     security={{"BearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="User ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name", type="string", example="Updated Name"),
     *             @OA\Property(property="email", type="string", format="email", example="updated@example.com")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="User updated")
     *         )
     *     ),
     *     @OA\Response(response=404, description="User not found")
     * )
     */
    public function update(Request $request, $id)
    {
        return response()->json(['message' => 'User updated']);
    }

    /**
     * @OA\Get(
     *     path="/albums/{id}",
     *     tags={"Albums"},
     *     summary="Get a user's details",
     *     description="Fetch a single user's details by ID",
     *     security={{"BearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the user to fetch",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", example="john@example.com")
     *         )
     *     ),
     *     @OA\Response(response=404, description="User not found")
     * )
     */

    public function show($id)
    {
        return response()->json([
            'id' => $id,
            'name' => 'John Doe',
            'email' => 'john@example.com'
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/albums/{id}",
     *     tags={"Albums"},
     *     summary="Delete a user",
     *     description="Deletes a user by ID",
     *     security={{"BearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="User ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(response=204, description="Deleted successfully"),
     *     @OA\Response(response=404, description="User not found")
     * )
     */
    
    public function destroy($id)
    {
        return response()->json(['message' => 'User deleted']);
    }
}
