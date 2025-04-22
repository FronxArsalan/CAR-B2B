<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tire;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    // index
    public function index(){
        $data['header_title'] = 'Admin Dashboard';
        $data['lowStockTires'] = Tire::whereColumn('quantite', '<=', 'low_stock_threshold')->get();
        return view('admin.index',$data);
    }
}
