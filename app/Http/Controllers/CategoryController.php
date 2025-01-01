<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Stringable;


class CategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $categories = Category::with('parent')->orderBy('id', 'desc')->get();
    // return $categories;
    return view("backend.categories.index", compact("categories"));
  }

  public function categoryUpdate(Request $request)
  {
    switch ($request->mode) {
      case 'true':
        Category::where('id', $request->id)->update([
          'status' => 'active'
        ]);
        break;
      default:
        Category::where('id', $request->id)->update([
          'status' => 'inactive'
        ]);
        break;
    }
    return response()->json(['message' => 'Status updated successfully', 'status' => true]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $category_title = Category::where('is_parent', true)->select('title', 'id')->get();
    return view('backend.categories.create', compact('category_title'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $valid_data = $request->validate([
      'title' => 'required|string',
      'summary' => 'nullable',
      'is_parent' => 'sometimes|in:1',
      'parent_id' => 'nullable',
      'status' => 'required|in:active,inactive',
    ]);

    $slug = $this->slug($request->title);
    $image = ($request->file('photo')) ? $this->imageHandler($request->file('photo')) : null;

    //merge the slug value with validated data
    $valid_data = array_merge($valid_data, ['slug' => $slug, 'photo' => $image]);

    // return $valid_data;

    Category::create($valid_data);
    return redirect()->route('category.index')->with('success', 'Banner created successfully');
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
    $image_path = $image->storeAs('images/categories', $valid_image_name, 'public');

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
    $image = Category::where('photo', $image_name)->first();
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
    $data = Category::where('slug', $slug)->first();
    if ($data) {
      return false;
    }
    return true;
  }

  /**
   * Display the specified resource.
   */
  public function show(Category $category)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Category $category)
  {
    $category_data = Category::where('is_parent', true)->select('id', 'title')->get();
    if ($category) {
      return view('backend.categories.edit', compact('category', 'category_data'));
    } else {
      return "Data not found";
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Category $category)
  {
    $slug = $this->slug($request->title);

    $valid_data = $request->validate([
      'title' => 'required|string',
      'summary' => 'nullable',
      'is_parent' => 'sometimes|in:1',
      'parent_id' => 'nullable',
      'status' => 'required|in:active,inactive',
    ]);
    if ($request->file('photo')) {
      //delete previous image
      $this->deleteExistingImage($category->photo);
      //set new image
      $image = $this->imageHandler($request->file('photo'));
      $valid_data = array_merge($valid_data, ['slug' => $slug, 'photo' => $image]);
    } else {
      $valid_data = array_merge($valid_data, ['slug' => $slug]);
    }

    $category->update($valid_data);
    return redirect()->route('category.index')->with('success', 'Category updated successfully');
  }

  protected function deleteExistingImage(string $image): void
  {
    $image_path = public_path("storage/$image");
    if (file_exists($image_path)) {
      unlink($image_path);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Category $category)
  {
    if ($category) {
      try {
        $category->delete();
        $this->deleteExistingImage($category->photo);
        return redirect()->route("category.index")->with("success", "Category successfully deleted");
      } catch (\Throwable $th) {
        throw $th;
      }
    }
    return back()->with('error', 'Something went wrong');
  }
}