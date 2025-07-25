<?php

namespace App\Http\Controllers;


use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function index(Request $request)
    {
       $products = Product::with('category')
       ->filter(request(['search', 'category']))
       ->latest()
       ->paginate(5)
       ->withQueryString();

       return Inertia::render('Products',
          [
            'products'=> $products,
            'searchTerm'=> $request->search,
            'categories' => Category::all(),
        ]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {

        $validated = $request->validated() ;
        // $validated['image_path'] = $request->file('image_path')->storePublicly('product', 'public');

        if ($request->hasfile('image_path')){
           $validated['image_path'] = $request->file('image_path')->store('product', 'public');
        }

        $validated['user_id'] = $request->user()->id;

         Product::create($validated);

    }

    /**
     * Display the specified resource.
     */
    public function show( Product $product )
    {

        return Inertia::render('Show',[
            'product'    => $product->load('category'), ///eager load the category function from the product model as the relation of the props
            'categories' => Category::all(),
            'canModify'  =>  Auth::user() ? Auth::user()->can('modify', $product) : false,
        ]);


    }



    /**
     * Update the specified resource in storage.
     */
  public function update(ProductRequest $request, string $id)
{
     Gate::authorize('modify', Product::findOrFail( $id ));

    $validated = $request->validated();

    $product = Product::findOrFail($id);

    // If new image is uploaded
    if ($request->hasFile('image_path')) {
        // Delete old image
        if (!is_null($product->image_path)) {
            Storage::disk('public')->delete($product->image_path);
        }

        // Store new image and update in validated data
        $validated['image_path'] = $request->file('image_path')->store('product', 'public');
    }

    // Update item with all validated data
    $result = $product->update($validated);

    return redirect()->back()->with('success', 'Product updated successfully');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('modify', Product::findOrFail( $id ));

          $product =  Product::findOrFail($id);

          if($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
          }

          $product->delete();


          return with('success','Product has been deleted successfully');
    }
}
