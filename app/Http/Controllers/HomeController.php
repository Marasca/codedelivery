<?php

namespace CodeDelivery\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            $route = 'customer.order.index';

            if (Auth::user()->role == 'admin') {
                $route = 'admin.orders.index';
            }

            return redirect()->route($route);
        }

        return redirect('/auth/login');
    }
}
