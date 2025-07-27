<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use DateTime;

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
        $user = session('user');

        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item->price * $item->quantity;
        }


        $order = [
            'totalPrice' => $totalPrice,
            'customer_id' => $memberId,
            'staff_id' => $user[0]->id

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


    function detailOrderPage($id)
    {
        $order = Order::with(['customer', 'staff'])->find($id);
        $orderDetail = OrderDetail::where('orders_id', $id)->with(['menus'])->get();


        return view('detailOrder')->with('order', $order)->with('orderDetail', $orderDetail);
    }

    function dashboardPage()
    {
        $allOrer = Order::all();
        $monthlySales = Order::all()
            ->groupBy(function ($item) {
                return Carbon::parse($item->createdAt)->format('Y-m');
            })
            ->map(function ($orders) {
                return $orders->sum('totalPrice');
            });

        $labels = $monthlySales->keys();
        $data = $monthlySales->values();

        return view('dashboard', compact('labels', 'data'))->with("orders", $allOrer);
    }


    public function filterDashboard(Request $req)
    {
        $allOrders = Order::all();

        $filterMonth = $req->input('filter-month'); // "January", "February", ..., หรือ "All"
        $filterYear = $req->input('filter-year');   // "2025", "2024", ..., หรือ "All"

        $Sales = [];
        if ($filterMonth == $filterYear) {
            $Sales = Order::all()
                ->groupBy(function ($item) {
                    return Carbon::parse($item->createdAt)->format('Y-m');
                })
                ->map(function ($orders) {
                    return $orders->sum('totalPrice');
                });
        } elseif (($filterMonth !== "All" && $filterYear === "All")) {
            
            $monthNumber = DateTime::createFromFormat('F', $filterMonth)->format('m');

            $Sales = Order::all()
                ->filter(function ($item) use ($monthNumber) {
                    return Carbon::parse($item->createdAt)->format('m') == $monthNumber;
                })
                ->groupBy(function ($item) {
                    
                    return Carbon::parse($item->createdAt)->format('Y-m');
                })
                ->map(function ($orders) {
                    return $orders->sum('totalPrice');
                });
        } elseif ($filterMonth === "All" && $filterYear !== "All") {
            // $yearNumber = DateTime::createFromFormat('F', $filterYear)->format('Y');

            $Sales = Order::all()
                ->filter(function ($item) use ($filterYear) {
                    return Carbon::parse($item->createdAt)->format('Y') == $filterYear;
                })
                ->groupBy(function ($item) {
                    
                    return Carbon::parse($item->createdAt)->format('Y-m');
                })
                ->map(function ($orders) {
                    return $orders->sum('totalPrice');
                });
        
        }elseif ($filterMonth !== "All" && $filterYear !== "All") {
            $monthNumber = DateTime::createFromFormat('F', $filterMonth)->format('m');

            $Sales = Order::all()
                ->filter(function ($item) use ($monthNumber) {
                    return Carbon::parse($item->createdAt)->format('m') == $monthNumber;
                })
                ->filter(function ($item) use ($filterYear) {
                    return Carbon::parse($item->createdAt)->format('Y') == $filterYear;
                })
                ->groupBy(function ($item) {
                    
                    return Carbon::parse($item->createdAt)->format('Y-m');
                })
                ->map(function ($orders) {
                    return $orders->sum('totalPrice');
                });
        
        }



        $labels = [];
        $data = [];

        if ($Sales) {
            $labels = $Sales->keys();
            $data = $Sales->values();
        }

        return view('dashboard', compact('labels', 'data'))->with("orders",  $allOrders);
    }
}
