<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;

class StationsController extends Controller
{
    public function index()
    {
        return View('layouts.addstation');
    }

}
