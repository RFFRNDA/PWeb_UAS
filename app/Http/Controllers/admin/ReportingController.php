<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\History;
use App\Models\Product;
use App\Models\Reporting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportingController extends Controller
{
    public function index(Request $request) {

    // $history_create = History::latest()->get()->toArray();
    $history_create = History::latest()->with('product')->skip(1)->take(PHP_INT_MAX)->get();



    return view('admin.reporting.list', compact('history_create'));

    }
}
