<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Stringable;

use function public_path;



class BannerController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $banners = Banner::orderBy('id', 'DESC')->get();
    return view('backend.banners.index', compact('banners'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('backend.banners.create');
  }


  /**
   * Method store
   *
   * @param Request $request [Store a newly created resource in storage.]
   *
   * @return RedirectResponse
   */
  public function store(Request $request): RedirectResponse
  {
    $valid_data = $request->validate([
      'title' => 'required|string',
      'url' => 'required|url',
      'description' => 'nullable',
      'status' => 'required|in:active,inactive',
      'condition' => 'required|in:banner,promo'
    ]);

    $slug = $this->slug($request->title);
    $image = ($request->file('photo')) ? $this->imageHandler($request->file('photo')) : null;

    //merge the slug value with validated data
    $valid_data = array_merge($valid_data, ['slug' => $slug, 'photo' => $image]);

    // return $valid_data;

    Banner::create($valid_data);
    return redirect()->route('banner.index')->with('success', 'Banner created successfully');
  }

  /**
   * Method imageHandler
   *
   * @param object $image [explicite description]
   *
   * @return mixed
   */
  protected function imageHandler(object $image): mixed
  {
    $image_name = $image->getClientOriginalName();
    // $image_extension = $image->extension();
    $image_new_name = time() . '_' . uniqid() . '_' . $image_name;
    $valid_image_name = $this->imageNameCheck($image_new_name);
    $image_path = $image->storeAs('images/banners', $valid_image_name, 'public');

    return $image_path;
  }

  /**
   * Method imageNameCheck
   *
   * @param $image_name $image_name [explicite description]
   *
   * @return mixed
   */
  protected function imageNameCheck($image_name): mixed
  {
    $image = Banner::where('photo', $image_name)->first();
    if ($image) {
      return $this->regenerateImageName($image_name);
    } else {
      return $image_name;
    }
  }

  /**
   * Method regenerateImageName
   *
   * @param $image_name $image_name [explicite description]
   *
   * @return string
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
  protected function slug($title): string|Stringable
  {
    $slug = str()->slug($title);
    if ($this->check_slug($slug) == false) {
      $slug = str()->slug($title) . '-' . uniqid() . '-' . time();
    }
    return $slug;
  }

  /**
   * Method check_slug
   *
   * @param $slug $slug [explicite description]
   *
   * @return bool
   */
  protected function check_slug($slug): bool
  {
    $data = Banner::where('slug', $slug)->first();
    if ($data) {
      return false;
    }
    return true;
  }

  /**
   * Method statusUpdate
   *
   * @param Request $request [explicite description]
   *
   * @return JsonResponse
   */
  public function statusUpdate(Request $request): JsonResponse
  {
    switch ($request->mode) {
      case 'true':
        Banner::where('id', $request->id)->update([
          'status' => 'active'
        ]);
        break;
      default:
        Banner::where('id', $request->id)->update([
          'status' => 'inactive'
        ]);
        break;
    }
    return response()->json(['message' => 'Status updated successfully', 'status' => true]);
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {

  }

  /**
   * Method edit [Show the form for editing the specified resource.]
   *
   * @param string $id [explicite description]
   *
   * @return string
   */
  public function edit(string $id): string|View
  {
    $banner = Banner::findOrFail($id);
    if ($banner) {
      return view('backend.banners.edit', compact('banner'));
    } else {
      return "Data not found";
    }
  }

  /**
   * Method update [Update the specified resource in storage.]
   *
   * @param Request $request
   * @param string $id [banner id]
   *
   * @return RedirectResponse
   */
  public function update(Request $request, string $id): RedirectResponse
  {
    $banner = Banner::findOrFail($id);
    $slug = $this->slug($request->title);

    $valid_data = $request->validate([
      'title' => 'required|string',
      'url' => 'required|url',
      'description' => 'nullable',
      'status' => 'required|in:active,inactive',
      'condition' => 'required|in:banner,promo'
    ]);
    if ($request->file('photo')) {
      //delete previous image
      $this->deleteExistingImage($banner->photo);
      //set new image
      $image = $this->imageHandler($request->file('photo'));
      $valid_data = array_merge($valid_data, ['slug' => $slug, 'photo' => $image]);
    } else {
      $valid_data = array_merge($valid_data, ['slug' => $slug]);
    }

    $banner->update($valid_data);
    return redirect()->route('banner.index')->with('success', 'Banner updated successfully');
  }

  /**
   * Method deleteExistingImage
   *
   * @param string $image [explicite description]
   *
   * @return void
   */
  protected function deleteExistingImage(string $image): void
  {
    $image_path = public_path("storage/$image");
    if (file_exists($image_path)) {
      unlink($image_path);
    }
  }

  /**
   * Method destroy [Remove the specified resource from storage.]
   *
   * @param string $id [explicite description]
   *
   * @return RedirectResponse
   */
  public function destroy(string $id): RedirectResponse
  {
    $banner = Banner::findOrFail($id);
    if ($banner) {
      try {
        $banner->delete();
        $this->deleteExistingImage($banner->photo);
        return redirect()->route("banner.index")->with("success", "Banner successfully deleted");
      } catch (\Throwable $th) {
        throw $th;
      }
    }
    return back()->with('error', 'Something went wrong');
  }
}