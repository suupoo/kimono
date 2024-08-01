<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Facades\Utility\CustomStorage as CustomStorage;

class MyPageController extends Controller
{
    public function index()
    {
        return view('mypage.index');
    }
}
