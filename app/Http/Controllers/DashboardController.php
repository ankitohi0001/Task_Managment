<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totaltasks = Task::count();
        $todaytasks =  Task::whereDate('created_at', Carbon::today())->count();
       $totalusers = User::count();
       $todayusers =  User::whereDate('created_at', Carbon::today())->count();


       return view('dashboard.index',compact('totaltasks','todaytasks','totalusers','todayusers'));
    }
}
