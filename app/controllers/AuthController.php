<?php
class AuthController extends BaseController {

  public function showLogin()
  {
    if (Auth::check())
    {
      return Redirect::to('dash');
    }
    return View::make('login');
  }

  public function postLogin()
  {
    $data = [
      'username' => Input::get('username'),
      'password' => Input::get('password')
    ];

    if (Auth::attempt($data, Input::get('remember')))
    {
      return Redirect::to('dash');
    }
    else{
      return Redirect::back()->with('error_message', 'Verifica tu información')->withInput();
    }

  }

  public function logout()
  {
    Auth::logout();
    return Redirect::to('login')->with('error_message', 'Saliste Correctamente');
  }

  public function showWelcome()
  {
    return View::make('auth/dash');
  }

  public function registerUser()
  {
    return View::make('register');
  }
}
