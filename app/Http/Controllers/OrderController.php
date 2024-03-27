<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Item;
use App\Models\Category;
use App\Models\Stock;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $item = Item::all();
        $user = User::all();
        $category = Category::all();
        return view('orders.create', compact('item', 'category', 'user'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $item = Item::all();
        $user = User::all();
        $category = Category::all();
        return view('orders.edit', compact('order', 'item', 'category', 'user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'item_id' => 'required|exists:items,id',
            'order_status' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            $order = Order::findOrFail($id);
            $oldQuantity = $order->quantity;

            $item = Item::findOrFail($request->item_id);
            $stock = Stock::where('item_id', $item->id)->first();

            $quantityDifference = $request->quantity - $oldQuantity;

            if ($stock->in_stock < $quantityDifference) {
                return redirect()->back()->withInput()->with('error', 'Not enough stock to update quantity');
            }

            $order->user_id = $request->user_id;
            $order->item_id = $request->item_id;
            $order->category_id = $item->category_id;
            $order->order_status = $request->order_status;
            $order->quantity = $request->quantity;
            $order->date = now();
            $order->price = $item->selling_price * $request->quantity;
            $order->save();

            $stock->in_stock -= $quantityDifference;
            $stock->save();

            return redirect()->route('order.index')->with('success', 'Order updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update order: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'item_id' => 'required|exists:items,id',
            'order_status' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            $item = Item::findOrFail($request->item_id);

            $stock = Stock::where('item_id', $item->id)->first();
            if ($stock->in_stock < $request->quantity) {
                $request->merge(['quantity' => $stock->in_stock]);
                return redirect()->back()->withInput()->with('error', 'Only ' . $stock->in_stock . ' items are available in stock. Order quantity adjusted.');
            }

            $order = new Order();
            $order->user_id = $request->user_id;
            $order->item_id = $request->item_id;
            $order->category_id = $item->category_id;
            $order->order_status = $request->order_status;
            $order->quantity = $request->quantity;
            $order->date = now();
            $order->price = $item->selling_price * $request->quantity;
            $order->save();

            $stock->in_stock -= $request->quantity;
            $stock->save();

            return redirect()->route('order.index')->with('success', 'Order placed successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to place order: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        Session::flash('success', 'Order deleted successfully');
        return redirect()->route('order.index');
    }
}
