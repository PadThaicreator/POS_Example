<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function Laravel\Prompts\alert;

class AdminController extends Controller
{
    //
    function index()
    {
        // $blogs = DB::table('blogs')->paginate(5);
        // $blogs = Blog::paginate(5);
        return view('main');
    }
    function order()
    {
        alert("ASDA");
        return view('order');
    }
}
