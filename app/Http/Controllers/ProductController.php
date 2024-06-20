<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getAllProduct() // Método renombrado a getAllProduct
    {
        $products = DB::table('products')->get();
        return response()->json($products);
    }

    public function getProductById($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        return response()->json($product);
    }

    public function getProductNameById($id)
    {
        $productName = DB::table('products')->where('id', $id)->value('name');
        return response()->json(['name' => $productName]);
    }

    public function getProductNames()
    {
        $productNames = DB::table('products')->pluck('name');
        return response()->json($productNames);
    }

    public function insertSingleProduct(Request $request)
    {
        DB::table('products')->insert([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);
        return response()->json(['message' => 'Product inserted']);
    }

    public function insertMultipleProducts(Request $request)
    {
        DB::table('products')->insert($request->all());
        return response()->json(['message' => 'Multiple products inserted']);
    }

    public function updateSingleProduct(Request $request, $id) // Método renombrado a updateSingleProduct
    {
        DB::table('products')->where('id', $id)->update($request->all());
        return response()->json(['message' => 'Product updated']);
    }

    public function updateMultipleProducts(Request $request)
    {
        DB::table('products')->where('quantity', '<', 50)->update(['quantity' => 50]);
        return response()->json(['message' => 'Multiple products updated']);
    }

    public function deleteSingleProduct($id)
    {
        DB::table('products')->where('id', $id)->delete();
        return response()->json(['message' => 'Product deleted']);
    }

    public function deleteMultipleProducts()
    {
        DB::table('products')->where('quantity', '<', 10)->delete();
        return response()->json(['message' => 'Multiple products deleted']);
    }

    public function joinQueries()
    {
        $products = DB::table('products')
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->select('products.*', 'order_items.order_id')
            ->get();
        return response()->json($products);
    }

    public function groupByHaving()
    {
        $inventory = DB::table('products')
            ->select(DB::raw('sum(quantity) as total_quantity, price'))
            ->groupBy('price')
            ->having('total_quantity', '>', 100)
            ->get();
        return response()->json($inventory);
    }
}
