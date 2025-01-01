<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Stringable;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $users = User::orderBy('id', 'DESC')->get();
    return view("backend.users.index", compact("users"));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('backend.users.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $valid_data = $request->validate([
      'full_name' => 'required',
      'email' => 'required',
      'password' => 'required|confirmed',
      'phone' => 'required',
      'address' => 'required',
      'role' => 'required|in:vendor,customer',
      'status' => 'required|in:active,inactive',
    ]);
    $username = $this->username($request->username);
    $image = ($request->file('photo')) ? $this->imageHandler($request->file('photo')) : null;

    //merge the slug value with validated data
    $valid_data = array_merge($valid_data, ['username' => $username, 'photo' => $image]);

    // return $valid_data;

    User::create($valid_data);
    return redirect()->route('user.index')->with('success', 'User created successfully');
  }

  /**
   * Display the specified resource.
   */
  public function show(User $user)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(User $user)
  {
    return view('backend.users.edit', compact('user'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, User $user)
  {
    $valid_data = $request->validate([
      'full_name' => 'required',
      'email' => 'required',
      'phone' => 'required',
      'address' => 'required',
      'role' => 'required|in:vendor,customer',
      'status' => 'required|in:active,inactive',
    ]);

    $username = $this->username($request->username);
    if ($request->file('photo')) {
      //delete previous image
      if ($user->photo) {
        $this->deleteExistingImage($user->photo);
      }
      //set new image
      $image = $this->imageHandler($request->file('photo'));
      $valid_data = array_merge($valid_data, ['username' => $username, 'photo' => $image]);
    } else {
      $valid_data = array_merge($valid_data, ['username' => $username]);
    }

    $user->update($valid_data);
    return redirect()->route('user.index')->with('success', 'User  updated successfully');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(User $user): RedirectResponse
  {
    if ($user) {
      try {
        $user->delete();

        // if user has profile photo then delete it
        if ($user->photo) {
          $this->deleteExistingImage($user->photo);
        }
        return back()->with("success", "User successfully deleted");
      } catch (\Throwable $th) {
        throw $th;
      }
    }
    return back()->with('error', 'Something went wrong');
  }

  /**
   * Method deleteExistingImage [delete the user profile photo]
   */
  protected function deleteExistingImage(string $image): void
  {
    $image_path = public_path("storage/$image");
    if (file_exists($image_path)) {
      unlink($image_path);
    }
  }

  /**
   * Method userStatusUpdate [update the user's status]
   */
  public function userStatusUpdate(Request $request): JsonResponse
  {
    $user = User::findOrFail($request->id);
    switch ($request->mode) {
      case 'true':
        $user->update(['status' => 'active']);
        break;
      default:
        $user->update(['status' => 'inactive']);
        break;
    }
    return response()->json(['message' => 'Status updated successfully', 'status' => true]);
  }

  /**
   * Method imageHandler [handle the user image]
   */
  protected function imageHandler(object $image): mixed
  {
    $image_name = $image->getClientOriginalName();
    // $image_extension = $image->extension();
    $image_new_name = time() . '_' . uniqid() . '_' . $image_name;
    $valid_image_name = $this->imageNameCheck($image_new_name);
    $image_path = $image->storeAs('images/users', $valid_image_name, 'public');

    return $image_path;
  }

  /**
   * Method imageNameCheck [check the image name for duplicate]
   */
  protected function imageNameCheck($image_name): mixed
  {
    $image = User::where('photo', $image_name)->first();
    if ($image) {
      return $this->regenerateImageName($image_name);
    } else {
      return $image_name;
    }
  }

  /**
   * Method regenerateImageName [if duplicate the image name]
   */
  protected function regenerateImageName($image_name): string
  {
    $valid_image_name = uniqid() . '_' . $image_name;
    return $valid_image_name;
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