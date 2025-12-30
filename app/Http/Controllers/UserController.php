<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
    *  @OA\Get(
    *     path="/users",
    *     tags={"Users"},
    *     summary="Get list of users",
    *     description="Get paginated list of users with search, filter, and sorting options.",
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

    //  Route Validation

    // Numeric , Alphabet , Alphanumeric , Slug , Username , UUID
    // [0-9]+ , [A-Za-z]+ , [A-Za-z0-9]+ , [A-Za-z0-9\-]+ , [A-Za-z][A-Za-z0-9_]+ , [0-9a-fA-F\-]{36}

    // Route Parameters
    // Optional Parameters    ?

//     $uri = $request->path();
//     $url = $request->url();

// $urlWithQueryString = $request->fullUrl();

// $request->host();
// $request->httpHost();
// $request->schemeAndHttpHost();

// $method = $request->method();


//             Request Path
//             Request Host
//             Request URL
//             Request Method
//             Request Route
//             Request Headers
//             Request bearerToken
//             Request IP
//             $input = $request->all();

//             $name = $request->input('name');

//             $value = $request->cookie('name');

//             $file = $request->file('photo');





    public function index()
    {  
        try { 
            $request->validate([
                "page"   => "integer|min:1",
                "per_page"  => "integer|min:1|max:100",
                "search" => "string|nullable",
                "status" => "in:active,inactive,blocked",
                "sort_by" => "string|nullable",
                "sort_order" => "string|nullable",
            ]);

            $page   = (int) $request->get('page', 1);
            $perPage  = (int) $request->get('per_page', 10);
            $search = $request->get('search', '');
            // $searchBy = $request->get('search_by','id');
            $status = $request->get('status', '');
            $sortBy    = $request->get('sort_by', 'id');
            $sortOrder = $request->get('sort_order', 'asc');

            $allowedSortColumns = ['id', 'name', 'email', 'created_at', 'status'];
            $allowedSortOrders = ['asc', 'desc'];
            $allowedParams = ['page', 'per_page', 'search', 'sort_by', 'sort_order', 'status'];

            $invalidParams = array_diff(array_keys($_GET),$allowedParams);
            if (!empty($invalidParams))
            {
                $errors = [];
                foreach($invalidParams as $param)
                {
                    $errors[] = [
                        "field" => $param,
                        "message" => "invalid query parameter ".$param,
                        "code" => 400,
                    ];
                }
                return $this->sendError('No Record Found');
            }
            
            if (!in_array($sortOrder, $allowedSortOrders)) {
                // $sortOrder = strtolower($sortOrder) === 'desc' ? 'desc' : 'asc';
                // Invalid sort Order Parameter 
            }
            
            if (!in_array($sortBy, $allowedSortColumns)) {
                // $sortBy = 'id'; // fallback to safe default
                // Sort By must be one of the .implode(',',$allowedSortColumns)
            }

            $offset = ($page > 1) ? ($page - 1) * $perPage : 0;

            if($page <= 0) {
                // Page must be an integer greater than zero 
            }

            if($perPage <= 0) {
                // Per Page must be an integer greater than zero 
            }

            if($page > $totalPages && $totalRecords != 0) {
                // Page Number Out Of Range
            }

            if($page > 100) {
                // Per Page Can't Exceed 100
            }



            $query = User::query();

            if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
                });
            }


            if (!empty($status)) {
                $query->where('status', $status);
            }

            $query->orderBy($sortBy, $sortOrder);

            $totalRecords = $query->count();
            $data = $query->offset($offset)->limit($perPage)->get();
            $totalPages = ceil($totalRecords / $perPage);

            $result = [
                "data"          => $data,
                "page"          => $page,
                "per_page"      => $perPage,
                "total_records" => $totalRecords,
                "total_pages"   => $totalPages,
            ];

            if ($data->isNotEmpty()) {
                return $this->sendResponse($result, 'Users fetched successfully');
            } else {
                return $this->sendError('No Record Found');
            }
        } catch (\Exception $e) {
            Log::error('Users List API Error', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'code'    => $e->getCode(),
                'trace'   => $e->getTraceAsString()
            ]);

            return $this->sendError('Internal Server Error');
        }
    }

    /**
     * @OA\Post(
     *     path="/users",
     *     tags={"Users"},
     *     summary="Create a user",
     *     security={{"BearerAuth":{}}},
     *     description="Creates a new user in the system",
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

        try {
            
            $request->validate([
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'phone'    => 'nullable|string',
                'status'   => 'nullable|in:active,inactive',
            ]);

            if ($validation->fails()) {

            } else {
                
                $user = new UserModel();
    
                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->password = Hash::make($request->password);
                $user->status = $request->status;
    
                if ($data->isNotEmpty()) {
                    return $this->sendResponse($result, 'Users Registered successfully');
                } else {
                    return $this->sendError('No Record Found');
                }
            }
        } catch (\Exception $e) {
            Log::error('Users Create API Error', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'code'    => $e->getCode(),
                'trace'   => $e->getTraceAsString()
            ]);

            return $this->sendError('Internal Server Error');
        } 
    }

    /**
     * @OA\Put(
     *     path="/users/{id}",
     *     tags={"Users"},
     *     summary="Update a user",
     * security={{"BearerAuth":{}}},
     *     description="Updates an existing user's details",
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
        try {

        } catch (\Exception $e) {
            Log::error('Users Create API Error', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'code'    => $e->getCode(),
                'trace'   => $e->getTraceAsString()
            ]);

            return $this->sendError('Internal Server Error');
        }
    }

    /**
     * @OA\Get(
     *     path="/users/{id}",
     *     tags={"Users"},
     * security={{"BearerAuth":{}}},
     *     summary="Get a user's details",
     *     description="Fetch a single user's details by ID",
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
        try {

        } catch (\Exception $e) {
            Log::error('Users Create API Error', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'code'    => $e->getCode(),
                'trace'   => $e->getTraceAsString()
            ]);

            return $this->sendError('Internal Server Error');
        }
    }

    /**
     * @OA\Delete(
     *     path="/users/{id}",
     *     tags={"Users"},
     *     summary="Delete a user",
     * security={{"BearerAuth":{}}},
     *     description="Deletes a user by ID",
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
        try {

        } catch (\Exception $e) {
            Log::error('Users Delete API Error', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'code'    => $e->getCode(),
                'trace'   => $e->getTraceAsString()
            ]);

            return $this->sendError('Internal Server Error');
        }
    }
}
