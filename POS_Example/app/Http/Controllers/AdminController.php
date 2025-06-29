<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Member;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //

    function index(Request $req)
    {
        $phone = $req->input('phone');
        $pass = $req->input('password');
        
        session()->flush();

        $user = Member::where('phoneNumber', $phone)->where('role', 'staff')->first();
        if(!$user){
            return redirect()->back()->withErrors(['login' => 'User Not Found'])->withInput();
        }

        if (Hash::check($pass, $user->password)) {
            
            session()->push('user' , $user);
            return view('main');
        } else {
            return redirect()->back()->withErrors(['login' => 'Invalid Phone Number or password'])->withInput();
        }
    }
    function orderPage()
    {
        $menus = Menu::where('status', 'available')->get();
        return view('order')->with('menus', $menus);
    }
    function summaryPage()
    {

        $user = Member::where('role', 'customer')->get();
        return view('summary')->with('user', $user);
    }

    function addPage()
    {

        return view('add');
    }
    function editPage()
    {
        $menus = Menu::all();
        return view('edit')->with('menus', $menus);
    }
    function allOrderPage()
    {

        $orders = Order::with(['customer', 'staff'])->get();
        return view('allorder')->with('orders', $orders);
    }





    function paymentPage(Request $request)
    {
        $cart = session('cart', []);
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item->price*$item->quantity;
        }


        $id = $request->input('member-id');
        if ($id) {
            $user = Member::find($id);
        } else {
            $user = null;
        }

        return view('payment')->with('totalPrice', $totalPrice)->with('user', $user);
    }

    function addMenu(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',


        ]);


        if ($request->input('mode') == 'add') {
            $category = $request->input('category', 'Food');
            $folder = 'menu_images/';
            $uploadedFile = Storage::disk('cloudinary')->putFile($folder, $request->file('image'));
            $url = 'https://res.cloudinary.com/dlsd9groz/image/upload/' . $uploadedFile;


            $menuItem = [
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'description' => $request->input('description'),
                'category' => $category,
                'status' => $request->input('status', 'available'),
                'image' => $url
            ];

            Menu::create($menuItem);
        } else if ($request->input('mode') == 'edit') {
            $menu = Menu::find($request->input('id'));

            if (!$menu) {
                return back()->withErrors(['error' => 'Menu not found.']);
            }
            if (!$request->file('image')) {
                $data = [
                    'name' => $request->input('name'),
                    'price' => $request->input('price'),
                    'description' => $request->input('description'),
                    'category' => $request->input('category'),
                    'status' => $request->input('status', 'available'),
                ];
                $menu->update($data);
            } else {


                $folder = 'menu_images/';
                $oldUrl = $menu->image;
                $filename = pathinfo(basename($oldUrl), PATHINFO_FILENAME);
                $fullPublicId = $folder  . $filename;

                (new UploadApi())->destroy($fullPublicId);

                $category = $request->input('category', 'Food');

                $uploadedFile = Storage::disk('cloudinary')->putFile($folder, $request->file('image'));
                $url = 'https://res.cloudinary.com/dlsd9groz/image/upload/' . $uploadedFile;

                $data = [
                    'name' => $request->input('name'),
                    'price' => $request->input('price'),
                    'description' => $request->input('description'),
                    'category' => $request->input('category'),
                    'status' => $request->input('status', 'available'),
                    'image' => $url
                ];

                $menu->update($data);
            }
        }

        return redirect()->route('editPage');
    }

    function editForm($id)
    {

        $Menu = Menu::where('id', $id)->first();

        return view("editForm")->with("Menu", $Menu);
    }
}
