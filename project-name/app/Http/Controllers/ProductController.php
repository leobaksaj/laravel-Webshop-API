<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\PriceList;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function filter(Request $request)
    {    
        $query = Product::query();

        if ($request->filled('min_price') && is_numeric($request->min_price)) {
            $query->where('price', '>=', $request->min_price);
        }
        
        if ($request->filled('max_price') && is_numeric($request->max_price)) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // if ($request->filled('category_name')) {
        //     $query->whereExists(function ($subquery) use ($request) {
        //         $subquery->select(DB::raw(1))
        //             ->from('category_product')
        //             ->join('categories', 'categories.id', '=', 'category_product.category_id')
        //             ->whereRaw('products.id = category_product.product_id')
        //             ->where('categories.name', 'like', '%' . $request->category_name . '%');
        //     });
        // }

        if ($request->filled('category_name')) {
            $categoryName = $request->category_name;

            $query->whereExists(function ($subquery) use ($categoryName) {
                $subquery->select(DB::raw(1))
                    ->from('category_product')
                    ->join('categories', function ($join) {
                        $join->on('categories.id', '=', 'category_product.category_id')
                            ->orWhere('categories.parent_id', '=', 'category_product.category_id');
                    })
                    ->whereRaw('products.id = category_product.product_id')
                    ->where(function ($nestedSubquery) use ($categoryName) {
                        $nestedSubquery->where('categories.name', 'like', '%' . $categoryName . '%')
                            ->orWhereExists(function ($subquery) use ($categoryName) {
                                $subquery->select(DB::raw(1))
                                    ->from('categories as parent')
                                    ->whereRaw('parent.id = categories.parent_id')
                                    ->where('parent.name', 'like', '%' . $categoryName . '%');
                            });
                    });
            });
        }

        // SORTIRANJE
        if ($request->filled('price_sort')) {
            $sortField = 'price';
            $sortOrder = $request->price_sort;
            $query->orderBy($sortField, $sortOrder);
        }

        if ($request->filled('name_sort')) {
            $sortField = 'name';
            $sortOrder = $request->name_sort;
            $query->orderBy($sortField, $sortOrder);
        }
        
        $products = $query->paginate(10);

        if ($products->isEmpty()) {
            return view('products.no_results');
        }

        return view('products.filter', ['products' => $products]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('products.index', ['products' => $products]);
        // return Product::all();
    }

    public function indexByCategory(Category $category)
    {
        $products = $category->products()->paginate(5);

        return view('products.indexByCategory', ['category' => $category, 'products' => $products]);
    }

    public function addCategory(Request $request, $productId)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['error' => 'Proizvod nije pronađen.'], 404);
        }

        $category = Category::find($request->input('category_id'));
        if (!$category) {
            return response()->json(['error' => 'Kategorija nije pronađena.'], 404);
        }

        if ($product->categories->contains($category->id)) {
            return response()->json(['error' => 'Proizvod već pripada ovoj kategoriji.'], 422);
        }

        $product->categories()->attach($category->id);

        return response()->json(['message' => 'Kategorija uspješno dodana proizvodu.']);

        $product = Product::find($productId);
        $category = Category::find($request->input('category_id'));
        $product->categories()->attach($category->id);

        return response()->json(['message' => 'Kategorija uspješno dodana proizvodu.']);
    }

    public function addPriceList(Request $request, Product $product)
    {
        $request->validate([
            'price_list_id' => 'required|exists:price_lists,id',
            'price' => 'required|numeric|min:0',
        ]);

        $priceList = PriceList::find($request->input('price_list_id'));

        if (!$priceList) {
            return response()->json(['error' => 'Cjenik nije pronađen.'], 404);
        }

        $product->priceLists()->attach($priceList->id, ['price' => $request->input('price')]);

        return response()->json(['message' => 'Proizvod uspješno povezan s cjenikom.']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'sku'          => 'required|string|max:50',
            'price'        => 'required|numeric|min:0',
            'is_published' => 'required|boolean',
        ]);
        $product = Product::create($request->all());
        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('priceLists')->find($id);

        if (!$product) {
            return response()->json(['error' => 'Proizvod nije pronađen.'], 404);
        }

        return response()->json(['product' => $product], 200);
    }

    public function showProduct(Product $product)
    {
        return view('products.show', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'         => 'sometimes|required|string|max:255',
            'sku'          => 'sometimes|required|string|max:50',
            'price'        => 'sometimes|required|numeric|min:0',
            'is_published' => 'sometimes|required|boolean',
        ]);

        $product = Product::findOrFail( $id );
        $product->update( $request->all() );

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Product::destroy( $id );
    }
}
