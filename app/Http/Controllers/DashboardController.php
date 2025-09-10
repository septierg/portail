<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user()->load('businesses');

        //$user = User::with(['businesses'])->get();dd($user);
        $product = Product::with(['business'])->get();

        return view('dashboard', compact('user', 'product'));

    }

    public function user()
    {

        dd(User::all(),auth()->user()->role);

    }

    public function super_admin()
    {

        $user = auth()->user();
        $user->role = 'superadmin';
        $user->save();
        return('super admin');
    }

    public function admin()
    {

        $user = auth()->user();
        $user->role = 'admin';
        $user->save();
        return('admin');
    }

}
