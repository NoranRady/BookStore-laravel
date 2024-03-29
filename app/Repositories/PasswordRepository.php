<?php
namespace App\Repositories;

use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\PasswordReset;
use App\Repositories\Interfaces\PasswordRepositoryInterface;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PasswordRepository implements PasswordRepositoryInterface
{
    private $password;
    public function __construct(PasswordReset $password)
    {

        $this->password = $password;
    }
    public function create( $email)
    {
        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json([
                'message' => 'We cant find a user with that e-mail address.',
            ], 404);
        }
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => str_random(60),
            ]
        );
        if ($user && $passwordReset) {
            $user->notify(
                new PasswordResetRequest($passwordReset->token)
            );
        }
        return response()->json([
            'message' => 'We have e-mailed your password reset link!',
        ]);
    }
    public function find($token)
    {
        $passwordReset = PasswordReset::where('token', $token)
            ->first();
        if (!$passwordReset) {
            return response()->json([
                'message' => 'This password reset token is invalid.',
            ], 404);
        }
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return response()->json([
                'message' => 'This password reset token is invalid.',
            ], 404);
        }return response()->json($passwordReset);
    }
    public function reset($email,$password,$token)
    {
        $passwordReset = PasswordReset::where([
            ['token',$token],
            ['email',$email],
        ])->first();
        if (!$passwordReset) {
            return response()->json([
                'message' => 'This password reset token is invalid.',
            ], 404);
        }

        $user = User::where('email', $passwordReset->email)->first();
        if (!$user) {
            return response()->json([
                'message' => 'We cant find a user with that e-mail address.',
            ], 404);
        }

        $user->password = bcrypt($password);
        $user->save();
        $passwordReset->delete();
        $user->notify(new PasswordResetSuccess($passwordReset));
        return response()->json($user);
    }
}
