<?php namespace App\Http\Controllers;

use Parsedown;
use Illuminate\Routing\Controller;
use OwenIt\Auditing\Log;

class LogController extends Controller
{
    /**
     * Show the logs for the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $logs = Log::orderBy('created_at', 'desc')->get();
        return view('log', compact('logs'));
    }

}