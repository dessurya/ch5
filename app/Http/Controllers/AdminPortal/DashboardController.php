<?php

namespace App\Http\Controllers\AdminPortal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Message;

class DashboardController extends Controller
{
	public function index(){
		return view('admin-portal.dashboard.index');
	}

	public function message(){
		$get = Message::get();

		return view('admin-portal.message.index', compact('get'));
	}
}
