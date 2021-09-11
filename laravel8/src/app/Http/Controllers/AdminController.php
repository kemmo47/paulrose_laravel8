<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Category;


class AdminController extends Controller
{
    public function dashboard() {
        return view('admin.trangchu_admin');
    }
}
