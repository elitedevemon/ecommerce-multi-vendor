<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Stringable;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $products = Product::with('vendor')->orderBy('id', 'DESC')->get();
    return view("backend.products.index", compact("products"));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $brands = Brand::select('id', 'title')->get();
    $categories = Category::select('id', 'title', 'is_parent')->get();
    $users = User::where('status', 'active')->select('id', 'full_name')->get();
    return view('backend.products.create', compact(['brands', 'categories', 'users']));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $valid_data = $request->validate([
      'title' => 'required',
      'summary' => 'nullable',
      'description' => 'nullable',
      'stock' => 'integer|nullable',
      'brand_id' => 'required',
      'category_id' => 'nullable',
      'child_category_id' => 'nullable',
      'status' => 'required|in:active,inactive',
      'price' => 'required',
      'offer_price' => 'nullable',
      'discount' => 'nullable|numeric',
      'size' => 'nullable|in:s,m,l,xl',
      'condition' => 'required|in:new,popular,winter',
      'vendor_id' => 'required',
    ]);
    $slug = $this->slug($request->title);
    $image = ($request->file('photo')) ? $this->imageHandler($request->file('photo')) : null;

    //merge the slug value with validated data
    $valid_data = array_merge($valid_data, ['slug' => $slug, 'photo' => $image]);

    // return $valid_data;

    Product::create($valid_data);
    return redirect()->route('product.index')->with('success', 'Product created successfully');
  }

  /**
   * Display the specified resource.
   */
  public function show(Product $product)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Product $product)
  {
    if ($product) {
      $brands = Brand::select('id', 'title')->get();
      $categories = Category::select('id', 'title', 'is_parent')->get();
      $users = User::where('status', 'active')->select('id', 'full_name')->get();
      return view('backend.products.edit', compact(['product', 'brands', 'categories', 'users']));
    } else {
      return "Data not found";
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Product $product)
  {
    $slug = $this->slug($request->title);

    $valid_data = $request->validate([
      'title' => 'required',
      'summary' => 'nullable',
      'description' => 'nullable',
      'stock' => 'integer|nullable',
      'brand_id' => 'required',
      'category_id' => 'nullable',
      'child_category_id' => 'nullable',
      'status' => 'required|in:active,inactive',
      'price' => 'required',
      'offer_price' => 'nullable',
      'discount' => 'nullable|numeric',
      'size' => 'nullable|in:s,m,l,xl',
      'condition' => 'required|in:new,popular,winter',
      'vendor_id' => 'required',
    ]);
    if ($request->file('photo')) {
      //delete previous image
      $this->deleteExistingImage($product->photo);
      //set new image
      $image = $this->imageHandler($request->file('photo'));
      $valid_data = array_merge($valid_data, ['slug' => $slug, 'photo' => $image]);
    } else {
      $valid_data = array_merge($valid_data, ['slug' => $slug]);
    }

    $product->update($valid_data);
    return redirect()->route('product.index')->with('success', 'Product updated successfully');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Product $product)
  {
    if ($product) {
      try {
        $product->delete();
        $this->deleteExistingImage($product->photo);
        return back()->with("success", "Product successfully deleted");
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
   * Method productStatusUpdate [update the product status]
   *
   * @param Request $request 
   *
   * @return JsonResponse
   */
  public function productStatusUpdate(Request $request): JsonResponse
  {
    switch ($request->mode) {
      case 'true':
        Product::where('id', $request->id)->update([
          'status' => 'active'
        ]);
        break;
      default:
        Product::where('id', $request->id)->update([
          'status' => 'inactive'
        ]);
        break;
    }
    return response()->json(['message' => 'Status updated successfully', 'status' => true]);
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
    $data = Product::where('slug', $slug)->first();
    if ($data) {
      return false;
    }
    return true;
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
    $image_path = $image->storeAs('images/products', $valid_image_name, 'public');

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
    $image = Product::where('photo', $image_name)->first();
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


}