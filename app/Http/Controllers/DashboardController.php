<?php

namespace App\Http\Controllers;

use App\GeneratedCode;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     * only authenticated user allow to access this function. because of "auth" is added in the Routes(routes/web.php) middleware
     * index function just get the count of random code & pass to the view
     */
    public function index()
    {
        $code = GeneratedCode::get()->count();
        return view('dashboard', compact('code'));
    }
}
