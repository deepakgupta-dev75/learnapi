<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Twilio\TwiML\VoiceResponse;


class AuthController extends Controller
{

    /**
     * @OA\Post(
     *     path="/auth/login",
     *     tags={"Auth"},
     *     summary="User Login (Public)",
     *     security={}, 
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", example="john@example.com"),
     *             @OA\Property(property="password", type="string", example="123456")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Login successful")
     * )
     */


    public function login()
    {
        return response()->json(['login']);
    }

    /**
     * @OA\Post(
     *     path="/auth/register",
     *     tags={"Auth"},
     *     summary="User Register (Public)",
     *     security={}, 
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email", "password"},
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", example="john@example.com"),
     *             @OA\Property(property="password", type="string", example="123456")
     *         )
     *     ),
     *     @OA\Response(response=201, description="User registered")
     * )
     */

    public function register()
    {
        return response()->json(['user1', 'user2']);
    }

    /**
     * @OA\Post(
     *     path="/auth/logout",
     *     tags={"Auth"},
     *     summary="Logout User",
     *     security={{"BearerAuth":{}}},
     *     @OA\Response(response=200, description="Logged out successfully")
     * )
     */

    public function logout()
    {
        return response()->json(['user1', 'user2']);
    }

    /**
     * @OA\Post(
     *     path="/auth/refresh",
     *     tags={"Auth"},
     *     summary="Refresh Token",
     *     security={{"BearerAuth":{}}},
     *     @OA\Response(response=200, description="Token refreshed")
     * )
     */


    public function refreshToken()
    {

        return response()->json(['user1', 'user2']);
    }


    /**
     * @OA\Get(
     *     path="/auth/me",
     *     tags={"Auth"},
     *     summary="Get authenticated user",
     *     security={{"BearerAuth":{}}},
     *     @OA\Response(response=200, description="User profile data")
     * )
     */


    public function getCurrentUserDetails()
    {
        return response()->json(['user1', 'user2']);
    }


    /**
     * @OA\Post(
     *     path="/auth/password/forgot",
     *     tags={"Auth"},
     *     summary="Forgot Password (Public)",
     *     security={}, 
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email"},
     *             @OA\Property(property="email", type="string", example="john@example.com")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Reset link sent")
     * )
     */

    public function forgotPassword()
    {
        return response()->json(['user1', 'user2']);
    }

    /**
     * @OA\Post(
     *     path="/auth/password/reset",
     *     tags={"Auth"},
     *     summary="Reset Password (Public)",
     *     security={}, 
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"token", "password"},
     *             @OA\Property(property="token", type="string", example="XYZ123"),
     *             @OA\Property(property="password", type="string", example="newpassword123")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Password reset successful")
     * )
     */

    public function resetPassword()
    {
        return response()->json(['user1', 'user2']);
    }

    /**
     * @OA\Post(
     *     path="/auth/password/change",
     *     tags={"Auth"},
     *     summary="Change User Password",
     *     description="Allows an authenticated user to change their password by providing the old password and a new password.",
     *     security={{"BearerAuth":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"old_password", "new_password"},
     *
     *             @OA\Property(property="old_password",type="string",example="OldPass@123",description="Current password of the user"),
     *             @OA\Property(property="new_password",type="string",example="NewStrongPass@456",description="New password to replace the old one")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Password changed successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Password updated successfully")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=400,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Invalid input data")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=403,
     *         description="Old password does not match",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Old password is incorrect")
     *         )
     *     )
     * )
     */


    public function changePasswordd(Request $request)
    {
        echo "Test";
    }





    private function generateAccessToken()
    {
        $payloads = [];
    }

    private function generateRefreshToken()
    {
        $payloads = [];
    }


    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email does not exist']);
        }

        // Generate token
        $token = generateToken($user->id);
        // Generate reset URL
        $resetUrl = url("/reset-password?token=" . $token . "&email=" . urlencode($user->email));

        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'reset_password_token' => $token,
                'reset_password_token_expires' => now()->addMinutes(30)
            ]);

        $html = view('templates.reset-password', [
            'user' => $user,
            'resetUrl' => $resetUrl
        ])->render();

        // Send email
        return sendEmail($user->email, 'Reset Your Password', $html);
    }

    public function registerr(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:191',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'confirmpassword' => 'required',
            'dob' => 'required|date',
            'phone' => 'required|string|unique:users,phone',
        ]);


        if ($validator->fails()) {
            print_r($validator->errors()); exit;
        }

        $user = new User();

        $user->name = $request->fullname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->dob = date("Y-m-d",strtotime($request->dob));
        $user->phone = $request->phone;
        $user->save();

        // Generate token
        $token = generateToken($user->id);
        // Generate reset URL
        $verifyUrl = url('/verify-email?token=' . $token . '&email=' . urlencode($user->email));

        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'email_verification_token' => $token
            ]);

        $html = view('templates.verify-email', [
            'user' => $user,
            'verifyUrl' => $verifyUrl
        ])->render();

        // send SMS
        // return sendSMS($request->phone, "Your OTP is: 123456");

        // Send email
        return sendEmail($user->email, 'Verify Your Email', $html);
    }

    public function verifyEmail(Request $request)
    {
        $user = User::where('email', $request->email)
            ->where('email_verification_token', $request->token)
            ->first();

        if (!$user) {
            return "Invalid or expired verification link!";
        }

        $user->is_email_verified = 1;
        $user->email_verified_at = now();
        $user->email_verification_token = null;
        $user->save();

        return "Your email has been successfully verified!";
    }
    
}
