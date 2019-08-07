<?php
namespace App\Repositories;

use App\Notifications\SignupActivate;
use App\Notifications\WelcomeMail;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Services\MailService;
class UserRepository implements UserRepositoryInterface
{

    public function signup($request)
    {

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'activation_token' => str_random(60),
        ]);
        $user->save();
        $user->notify(new SignupActivate($user));
        return response()->json([
            'message' => 'Successfully created user!',
        ], 201);

    }
    public function signupActivate($token)
    {

        $user = User::where('activation_token', $token)->first();
        if (!$user) {
            return response()->json([
                'message' => 'This activation token is invalid.',
            ], 404);
        }$user->active = true;
        $user->activation_token = '';
        $user->save();
        //$user->notify(new WelcomeMail($user));
        //Mail::to($user->email)->send(new MailService($user->name));
        Mail::to($user->email)->queue(new MailService($user->name));
        return $user;
    }
    public function login($request)
    {
        $credentials = request(['email', 'password']);
        $credentials['active'] = 1;
        $credentials['deleted_at'] = null;
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
        ]);

    }
    public function logout($request){
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }
    public function user($request)
    {
        return response()->json($request->user());
    }
}
