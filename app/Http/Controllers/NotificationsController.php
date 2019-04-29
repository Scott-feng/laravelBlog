<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $notifications = Auth::user()->notifications()->orderBy('created_at','desc')->paginate(20);

        Auth::user()->markAsRead();
        return view('notifications.index',compact('notifications'));
    }
}
