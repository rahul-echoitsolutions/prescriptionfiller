<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends CustomController
{

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  Request $request
	 * @return User
	 */
	public function store(Request $request)
	{


		$user = new User();
		$user->fill($request->all());
		$user->name = $user->email;
		$user->password = bcrypt($user->password);
		if (User::where('email', '=', $user->email)->exists()) {

			return $this->respond($user, true, 8);
		}

		$user->push();
		return $this->respond($user, false, 0);


	}


	/* return User::create([
	   'name' => $request['email'],
	   'email' => $request['email'],
	   'password' => bcrypt($request['password']),
	   'date_of_birth' => $request['date_of_birth'],
	   'sex' => $request['sex'],
	   'first_name' => $request['first_name'],
	   'phone_number' => $request['phone_number'],
	   'last_name' => $request['last_name'],
	   'notes' => $request['notes']
	   ]); */




	/**
	 * Display the specified resource.
	 *
	 * @param  \App\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function show(User $user)
	{
		return $this->respond($user, false, 0);
	}

	/**
	 * 
	 *
	 **/
	public function index()
	{
		return $this->respond(Auth::user(), false, 0);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\User user
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, User $user)
	{
		$user->update($request->all());
		$user->password = bcrypt($user->password);
		$user->name = $user->email;
		$user->save();
		return $this->respond($user, false, 0);
	}
}
