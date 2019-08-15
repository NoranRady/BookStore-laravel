<?php
namespace App\Repositories;

use App\Notifications\SignupActivate;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\MailService;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Role;

class UserRepository implements UserRepositoryInterface
{

    
    public function signup($name,$position,$email,$password)
    {

        $user = new User([
            'name' => $name,
            'position'=>$position,
            'email' => $email,
            'password' => bcrypt($password),
            'activation_token' => str_random(60),
        ]);
        $role=$position ;
        $user->save();
        $user
            ->roles()
            ->attach(Role::where('name',$role)->first());
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
    public function login($email, $password,$user,$request)
    {
        //$credentials = request(['email', 'password']);
        $credentials['email'] = $email;
        $credentials['password']=$password;
        $credentials['active'] = 1;
        $credentials['deleted_at'] = null;
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = $request->user();
  //dd($request->user());
  //dd($user);
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
        ]);

    }
    public function logout($user)
    {
        $user->token()->revoke();
       // $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }
    public function user($user)
    {
        return response()->json($user);
    }
}
