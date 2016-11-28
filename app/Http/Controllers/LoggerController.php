<?php

namespace App\Http\Controllers;

use \LoggingAction;
use Auth;

class Logger extends Controller
{
    public function logAction(LoggingAction $action){

        $logger = new Logger2();

        if(Auth::check()){
            $logger->user = Auth::user()->id;
        }else{
            $logger->user = "not logged in";
        }

        $logger->action = $action;
        $logger->ip = $_SERVER['REMOTE_ADDR'];

        return $logger;

    }
}
