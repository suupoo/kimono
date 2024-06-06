<?php

namespace App\Http\Controllers;

use stdClass;

abstract class ResourceController extends Controller
{
    protected string $model;

    protected array $views = [
        'create' => 'resources.default.create',
    ];

    /**
     * Create form of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new stdClass();
        $data->model = new $this->model();

        return view($this->views['create'], compact('data'));
    }
}
