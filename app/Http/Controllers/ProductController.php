<?php

namespace App\Http\Controllers;


use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use App\Models\Category;
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
         if (!Auth::check()) {
        abort(403, 'Not authenticated');
    }

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
    public function show( string $id )
    {
        Product::findorFail($id);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request,string $id)
    {
         $validated = $request->validated();
         $item = Product::findOrFail($id);

           // If new image is uploaded
    if ($request->hasFile('image_path')) {
        // Delete old image
        if (!is_null($item->image_path)) {
            Storage::disk('public')->delete($item->image_path);
        }

        // Store new image and update in validated data
        $validated['image_path'] = $request->file('image_path')->store('product', 'public');
    }

      // Update item with all validated data (including new image_path if applicable)
        Product::update($validated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::findOrFail($id);
    }
}
