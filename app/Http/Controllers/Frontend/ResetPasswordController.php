<?php

namespace App\Http\Controllers\Frontend;

use App\Commons\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PasswordReset;
use App\Notifications\ResetPasswordRequest;
use Carbon\Carbon;
use Illuminate\Support\Str;


class ResetPasswordController extends Controller
{
    private $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function sendMail(Request $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();

        if (!$user) {
            return $this->response->formatResponse(200, [], 'Email not found!');
        }

        $passwordReset = PasswordReset::updateOrCreate([
            'email' => $user->email,
        ], [
            'token' => Str::random(60),
        ]);

        if ($passwordReset) {
            $user->notify(new ResetPasswordRequest($passwordReset->token));
        }

        return $this->response->formatResponse(200, [], 'Password reset email has been sent.');
    }
}
