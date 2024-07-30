<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Facades\Utility\CustomStorage as CustomStorage;

class MyPageController extends Controller
{
    public function index()
    {


//        dd(Storage::disk('openstack'));
        $exists = Storage::disk('openstack')->fileExists('test.jpg');
        dd($exists);
        return view('mypage.index');
    }
}
