<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    public function index()
    {
         $products = Product::with('productimage')->latest()->paginate(10);
        // return $products;
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
  ;
        return view('admin.product.createproduct', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'category_id' => 'required',
                'subcategory_id' => 'required',
                'titel' => 'required',
                'price' => 'required',
                'sku' => 'required',
                'short_description' => 'required',
                'description' => 'required',
                'specification' => 'required'
            ]);

            $product = Product::create($validatedData);


                foreach ($request->file('image') as $image) {
                   $extension = $image->getClientOriginalExtension();
                   $createname = $product->id . '_'. uniqid() . '.' . $extension;
                //    $movepath = $image->storeAs('uploads/products', $createname, 'public');
                   $imagePath = $image->move(public_path('uploads/products'), $createname);
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $createname,
                        'type' => 'product'
                    ]);
                }
            return redirect()->back()->with('success', 'Product created successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->withInput()->with('error', 'Failed to create product. Error: ' . $e->getMessage());
        }
    }

    public function getSubcategories(Request $request)
    {

        $subcategories = Subcategory::where('category_id', $request->category_id)->pluck('subcategory_name', 'id');
        return response()->json([
            'status' => true,
            'subcategories' => $subcategories
        ]);
    }

    public function updateStatus(Request $request)
    {
        $product = Product::find($request->product_id);
        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found!'
            ], 404);
        }
        if ($request->type == 'is_featured') {

            $product->featured = $product->status == '1' ? '0' : '1';
        } elseif ($request->type == 'status') {
            $product->status = $product->status == '1' ? '0' : '1';
        }
        //    return $product;
        $product->save();
        return response()->json([
            'status' => true,
            'message' => 'Product Status Changed'
        ]);
    }

    public function destroy($id){

        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found!'
            ], 404);
        }
        $product->delete();
        return response()->json([
            'status' => true,
            'message' => 'Product Deleted'
        ]);
    }


    public function edit($id){

        $product = Product::with('productimage')->find($id);
        $categories = Category::with('subcategory')->get();

        if (!$product) {
            return  redirect()->back()->with('error', 'Product not found!');
        }
       return view('admin.product.edit', compact('product', 'categories'));
    }


    public function update(Request $request, $id){

        return dd($request->all());

        $product = Product::find($id);
        if (!$product) {
            return  redirect()->back()->with('error', 'Product not found!');
        }
        $validatedData = $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'titel' => 'required',
            'price' => 'required',
            'sku' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'specification' => 'required'
        ]);
        $product->update($validatedData);

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $extension = $image->getClientOriginalExtension();
                $createname = $product->id . '_'. uniqid() . '.' . $extension;
                $imagePath = $image->move(public_path('uploads/products'), $createname);
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $createname,
                    'type' => 'product'
                ]);
            }
        }
    }












    public function removeimage($id){
        $image = ProductImage::find($id);
        if (!$image) {
            return response()->json([
                'status' => false,
                'message' => 'Image not found!'
            ], 404);
        }
        $imagepath = public_path('uploads/products/' . $image->image);
        $unlink = @unlink($imagepath);

        $image->delete();
        return response()->json([
            'status' => true,
            'message' => 'Image Deleted'
        ]);
    }
}
