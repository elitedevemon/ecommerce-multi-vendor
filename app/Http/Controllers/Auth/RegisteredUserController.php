<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Stringable;

class RegisteredUserController extends Controller
{
  /**
   * Display the registration view.
   */
  public function create(): View
  {
    return view('auth.register');
  }

  /**
   * Handle an incoming registration request.
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  public function store(Request $request): RedirectResponse
  {
    $valid_data = $request->validate([
      'full_name' => 'required',
      'email' => 'required',
      'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);
    $username = $this->username($request->username);

    //merge the slug value with validated data
    $valid_data = array_merge($valid_data, ['username' => $username, 'role' => 'customer']);

    $user = User::create($valid_data);

    event(new Registered($user));

    Auth::login($user);
    return redirect(route(Auth::user()->role, absolute: false))->with('success', 'User created successfully');

    // return redirect(route('dashboard', absolute: false));
  }

  /**
   * Method slug
   *
   * @param $title $title [explicite description]
   *
   * @return string
   */
  protected function username(string $username): string|Stringable
  {
    if ($this->check_username($username) == false) {
      $username .= time();
    }
    return $username;
  }

  /**
   * Method check_slug
   *
   * @param $slug $slug [explicite description]
   *
   * @return bool
   */
  protected function check_username($username): bool
  {
    $data = User::where('username', $username)->first();
    if ($data) {
      return false;
    }
    return true;
  }
}