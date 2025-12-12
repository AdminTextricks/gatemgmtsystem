<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GateAdmin;
use Illuminate\Http\Request;

class GateAdminController extends Controller
{
    public function index()
    {
        $data = GateAdmin::all();
        return view('admin.gateadmin.index', compact('data'));
    }
}
