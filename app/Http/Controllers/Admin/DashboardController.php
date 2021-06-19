<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\City;
use App\Models\Place;
use App\Models\Product;
use App\Models\Transport;
use App\Models\Store;
use App\Models\Review;
use App\Models\Subscriber;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $users = Subscriber::query()
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.dashboard.index', [
            'users' => $users
        ]);
    }
}
