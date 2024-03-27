<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Stock;
use App\Models\Item;
use App\Models\Category;

class StockController extends Controller
{
    public function index(){
        $stocks = Stock::all();
        return view('stock.index', compact('stocks'));

    }
    public function destroy($id)
{
    try {
        $stock = Stock::findOrFail($id);
        $stock->delete();

        // Delete related items if needed
        // $items = Item::where('stock_id', $id)->get();
        // foreach ($items as $item) {
        //     $item->delete();
        // }

        return redirect()->route('stock.index')->with('success', 'Stock item deleted successfully');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to delete stock item: ' . $e->getMessage());
    }
}

}
