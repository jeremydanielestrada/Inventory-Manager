<?php

namespace App\Http\Controllers;


use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Support\Facades\Log;

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
            'product'=> $product->load('category'), ///eager load the category function from the product model as the relation of the props
            'categories' => Category::all(),
        ]);


    }



    /**
     * Update the specified resource in storage.
     */
  public function update(ProductRequest $request, string $id)
{
    Log::info('Update method called with ID: ' . $id);
    Log::info('Request data: ', $request->all());

    $validated = $request->validated();
    Log::info('Validated data: ', $validated);

    $product = Product::findOrFail($id);
    Log::info('Found product: ', $product->toArray());

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
    Log::info('Update result: ' . ($result ? 'true' : 'false'));

    return redirect()->back()->with('success', 'Product updated successfully');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::findOrFail($id);
    }
}
