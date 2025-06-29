<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    //
    public function addToCart(Request $request)
    {

        $cart =  session('cart', []);
        $found = false;
        if (isset($cart)) {
            foreach ($cart as $item) {
                if ($item->id == $request->input('menu_id')) {
                    $item->quantity += 1;
                    $found = true;
                    break;
                }
            }
        }


        if (!$found) {
            $item = Menu::find($request->input('menu_id'));
            $item->quantity = 1;
            session()->push('cart', $item);
        } else {
            session(['cart' => $cart]);
        }







        // dd(session('cart'));


        return redirect()->back();
    }

    public function clearCart()
    {
        session()->forget('cart');

        return redirect()->back();
    }

    public function createOrder(Request $request)
    {
        $memberId = $request->input('member-id');

        $cart = session('cart', []);
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item->price;
        }


        $order = [
            'totalPrice' => $totalPrice,
            'customer_id' => $memberId,
            'staff_id' => 1

        ];
        $newOrder = Order::create($order);

        foreach ($cart as $item) {
            OrderDetail::create([
                'orders_id' => $newOrder->id,
                'menus_id' => $item->id,
                'price' => $item->price,
                'amount' => $item->quantity
            ]);
        }

        session()->forget('cart');

        return redirect()->route('orderPage');
    }
}
