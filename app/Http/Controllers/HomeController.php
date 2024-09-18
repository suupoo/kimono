<?php

namespace App\Http\Controllers;

use App\UseCases\HomeAction\IndexAction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request, IndexAction $action)
    {
        $data = $action($request);
        return view('home.index', $data);
    }
}
