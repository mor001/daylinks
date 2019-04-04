<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Auth\ResetsPasswords;

class UsersController extends Controller
{
    use SendsPasswordResetEmails;
    use ResetsPasswords {
        //ResetsPasswords::broker insteadof ResetsPasswords;
        ResetsPasswords::resetPassword as resetPassword2; 
    }

    public function __construct()
    {
        //$this->middleware('guest');
    }
    
    //
    public function getUserslist()
    {
        return ['result' => true, 'users' => User::all()];
    }
    public function getUserDetail($id = null)
    {
        return ['result' => true, 'users' => User::where('id', $id)->get()];
    }
    public function save(Request $request)
    {
        $validatedData = $request->validate([
          'userid' => 'required|unique:users|max:16|alpha_num',
          'name'  => 'required|max:32',
          'email' => 'email',
          'password'=> 'required',
          'limit' => 'required|integer',
        ]);

        return ['result' => false, 'message' => '利用者登録に失敗しますた(´・ω・｀)'];
    }
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
            ? response()->json(['result' => true, 'message' => 'Reset link sent to your email.'], 200)
            : response()->json(['result' => false, 'message' => 'Unable to send reset link'], 200);
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request)
    {
        $this->validate($request, $this->rules(), $this->validationErrorMessages());

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword2($user, $password); // call ResetsPasswords->resetPassword
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
            ? response()->json(['result' => true, 'message' => trans($response)], 200)
            : response()->json(['result' => false, 'message' => trans($response)], 200);
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker();
    }
}
