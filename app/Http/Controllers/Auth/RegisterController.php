<?php

namespace App\Http\Controllers\Auth;

use Bouncer;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
						'color' => [
							'required',
							'string',
							'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/',
						],
            'password' => 'required|string|min:6|confirmed',
					], [
						'name.required' => 'O campo nome é obrigatório.',
						'email.required' => 'O campo email é obrigatório.',
						'name.max' => 'O campo nome deve ter até 255 caracteres.',
						'color.required' => 'O campo cor é obrigatório.',
						'color.regex' => 'Formato inválido no campo cor.',
						'password.required' => 'O campo senha é obrigatório.',
					]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'color' => $data['color'],
            'description' => $data['description'],
            'cel' => $data['cel'],
            'password' => bcrypt($data['password']),
        ]);

				$user->assign('coord');

				return $user;
    }
}
