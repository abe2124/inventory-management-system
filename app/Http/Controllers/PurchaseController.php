<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Stock;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Support\Facades\Session;



class PurchaseController extends Controller
{
    public function index(){
        $purchase = Purchase::all();

        return view('purchases.index', compact('purchase'));
    }
    public function create(){
        $item= Item::all();
        $category= Category::all();

        return view('purchases.create', compact('category', 'item'));
    }
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            // Add validation rules for other fields if needed
        ]);

        // Fetch the item and category
        $item = Item::findOrFail($request->item_id);
        // dd($item);

        // Assuming you have a Category model and you want to associate a category with the stock
        // $category = Category::findOrFail($request->category_id);

        // Create a new purchase record
        $purchase = new Purchase();
        $purchase->item_id = $item->id;
        $purchase->date = now();
        $purchase->unit_price =$item->selling_price;

        // Assign values from the request
        $purchase->fill($request->only(['category_id', 'total_price', 'status', 'quantity']));
        $purchase->save();


        $stock = Stock::where('item_id', $item->id)->first();

        if ($stock) {
            // If the item exists in the stock table, update the stock and in_stock fields
            $stock->increment('stock', $request->quantity);
            $stock->increment('in_stock', $request->quantity);
        } else {
            // If the item doesn't exist in the stock table, create a new stock record
            $stock = new Stock();
            $stock->item_id = $item->id;
            $stock->in_stock = $request->quantity;
            $stock->category_id = $request->category_id;

            $stock->stock = $request->quantity;
            $stock->save();
        }
        return redirect()->route('purchase')->with('success', 'Purchased successfully');
    }
    public function getItems(Request $request)
    {
        $categoryId = $request->input('category_id');
        $items = Item::where('category_id', $categoryId)->get();

        return response()->json($items);
    }
    public function getItemPrice($id)
    {
        $item = Item::findOrFail($id);
        return response()->json(['selling_price' => $item->selling_price]);
    }
    public function getSellingPrice($itemId)
{
    $item = Item::find($itemId);
    if ($item) {
        return response()->json(['selling_price' => $item->selling_price]);
    } else {
        return response()->json(['error' => 'Item not found'], 404);
    }
}
public function getBuyingPrice($itemId)
{
    $item = Item::find($itemId);
    if ($item) {
        return response()->json(['buying_price' => $item->buying_price]);
    } else {
        return response()->json(['error' => 'Item not found'], 404);
    }
}
public function destroy($id)
    {
        $Purchase = Purchase::findOrFail($id);
        $Purchase->delete();
        Session::flash('success', 'purchases deleted successfully');
        return redirect()->route('purchase');
    }



}
