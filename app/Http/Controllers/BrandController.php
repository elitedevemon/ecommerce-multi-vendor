<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Stringable;

class BrandController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $brands = Brand::orderBy('id', 'desc')->get();
    // return $categories;
    return view("backend.brands.index", compact("brands"));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('backend.brands.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $valid_data = $request->validate([
      'title' => 'required|string',
      'status' => 'required|in:active,inactive',
    ]);

    $slug = $this->slug($request->title);
    $image = ($request->file('photo')) ? $this->imageHandler($request->file('photo')) : null;

    //merge the slug value with validated data
    $valid_data = array_merge($valid_data, ['slug' => $slug, 'photo' => $image]);

    // return $valid_data;

    Brand::create($valid_data);
    return redirect()->route('brand.index')->with('success', 'Brand created successfully');
  }

  /**
   * Display the specified resource.
   */
  public function show(Brand $brand)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Brand $brand)
  {
    if ($brand) {
      return view('backend.brands.edit', compact('brand'));
    } else {
      return "Data not found";
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Brand $brand)
  {
    $slug = $this->slug($request->title);

    $valid_data = $request->validate([
      'title' => 'required|string',
      'status' => 'required|in:active,inactive',
    ]);
    if ($request->file('photo')) {
      //delete previous image
      $this->deleteExistingImage($brand->photo);
      //set new image
      $image = $this->imageHandler($request->file('photo'));
      $valid_data = array_merge($valid_data, ['slug' => $slug, 'photo' => $image]);
    } else {
      $valid_data = array_merge($valid_data, ['slug' => $slug]);
    }

    $brand->update($valid_data);
    return redirect()->route('brand.index')->with('success', 'Category updated successfully');
  }

  /**
   * Method destroy [Remove the specified resource from storage.]
   *
   * @param Brand $brand
   *
   * @return RedirectResponse
   */
  public function destroy(Brand $brand): RedirectResponse
  {
    if ($brand) {
      try {
        $brand->delete();
        $this->deleteExistingImage($brand->photo);
        return redirect()->route("brand.index")->with("success", "Brand successfully deleted");
      } catch (\Throwable $th) {
        throw $th;
      }
    }
    return back()->with('error', 'Something went wrong');
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
   * Method brandUpdate [update the brand status]
   *
   * @param Request $request 
   *
   * @return JsonResponse
   */
  public function brandUpdate(Request $request): JsonResponse
  {
    switch ($request->mode) {
      case 'true':
        Brand::where('id', $request->id)->update([
          'status' => 'active'
        ]);
        break;
      default:
        Brand::where('id', $request->id)->update([
          'status' => 'inactive'
        ]);
        break;
    }
    return response()->json(['message' => 'Status updated successfully', 'status' => true]);
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
    $image_path = $image->storeAs('images/brands', $valid_image_name, 'public');

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
    $image = Brand::where('photo', $image_name)->first();
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
    $data = Brand::where('slug', $slug)->first();
    if ($data) {
      return false;
    }
    return true;
  }

}