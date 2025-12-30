<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Learn API",
 *      description="API documentation for Learn API project",
 * 
 *      @OA\Contact(
 *          name="ER. D K Gupta",
 *          email="gdeepak2075@gmail.com",
 *          url="http://obs.com"
 *      )
 * )
 * 
 * @OA\Server(url="http://api.obs.com/api/v1", description="Development server")
 * @OA\Server(url="http://staging.obs.com/api/v1", description="Staging server")
 * @OA\Server(url="http://obs.com/api/v1", description="Production server")
 * 
 * security={{"BearerAuth": {}}}
 * 
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT"
 * )
 * 
 * @OA\Tag(name="IVR", description="Interactive Voice Recording")
 * @OA\Tag(name="Admin", description="Administration and system control")
 * @OA\Tag(name="Albums", description="Album and media management")
 * @OA\Tag(name="Auth", description="Authentication and token management")
 * @OA\Tag(name="Calls", description="Call logs and call activities")
 * @OA\Tag(name="Carts", description="Shopping cart operations")
 * @OA\Tag(name="Cart Items", description="Manage items inside cart")
 * @OA\Tag(name="Comments", description="Comments and feedback management")
 * @OA\Tag(name="Files", description="File upload and storage management")
 * @OA\Tag(name="Logs", description="System logs and monitoring")
 * @OA\Tag(name="Messages", description="Chat and messaging system")
 * @OA\Tag(name="Notifications", description="Push and in-app notifications")
 * @OA\Tag(name="Health Check", description="Health, liveness and readiness checks")
 * @OA\Tag(name="Orders", description="Order placement, tracking and management")
 * @OA\Tag(name="Order Items", description="Order item details and updates")
 * @OA\Tag(name="Products", description="Product listing and management")
 * @OA\Tag(name="Product Categories", description="Product category management")
 * @OA\Tag(name="Posts", description="Blog posts and content publishing")
 * @OA\Tag(name="Payments", description="Payment processing and transactions")
 * @OA\Tag(name="Photos", description="Photo and media gallery")
 * @OA\Tag(name="Roles", description="User roles and permissions management")
 * @OA\Tag(name="Reports", description="Reports, analytics and dashboard")
 * @OA\Tag(name="Settings", description="System and user settings")
 * @OA\Tag(name="Todos", description="To-do task management")
 * @OA\Tag(name="Users", description="User accounts, profiles and management")
 * 
 * 
 */

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function getMcqs()
    {
        $data['questions'] = [
            [
                'id' => 1,
                'question' => 'What is the capital of India?',
                'options' => [
                    ['id' => 1, 'option' => 'Mumbai'],
                    ['id' => 2, 'option' => 'New Delhi'],
                    ['id' => 3, 'option' => 'Kolkata'],
                    ['id' => 4, 'option' => 'Chennai'],
                ],
            ],
            [
                'id' => 2,
                'question' => 'Which planet is known as Red Planet?',
                'options' => [
                    ['id' => 1, 'option' => 'Earth'],
                    ['id' => 2, 'option' => 'Mars'],
                    ['id' => 3, 'option' => 'Jupiter'],
                    ['id' => 4, 'option' => 'Venus'],
                ],
            ],
            [
                'id' => 3,
                'question' => 'What is the chemical symbol of water?',
                'options' => [
                    ['id' => 1, 'option' => 'O2'],
                    ['id' => 2, 'option' => 'H2O'],
                    ['id' => 3, 'option' => 'CO2'],
                    ['id' => 4, 'option' => 'NaCl'],
                ],
            ],
        ];
        return view('welcome',$data);
    }

    // protected function successResponse($data = [], $message = 'Success', $statusCode = 200)
    // {
    //     return $this->response->setStatusCode($statusCode)->setJSON([
    //         'status'  => 'success',
    //         "success" => true,
    //         'message' => $message,
    //         'data'    => $data,
    //     ])->send();
    // }


    //  protected function errorResponse($errors = [], $message = 'Error', $statusCode = 400)
    // {
    //     return $this->response->setStatusCode($statusCode)->setJSON([
    //         'status'  => 'error',
    //         "success" => false,
    //         'message' => $message,
    //         'errors'  => $errors,
    //     ])->send();
    // }


    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function resetPassword()
    {
        return view('auth.reset-password');
    }

    public function changePassword()
    {
        return view('auth.change-password');
    }
}
