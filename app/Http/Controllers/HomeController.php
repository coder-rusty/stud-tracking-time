<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;    
use App\Models\Logged;  
use Carbon\Carbon;  
class HomeController extends Controller
{
   public function index(){

    if(Auth::id()){
        $usertype = Auth()->user()->usertype;
        
        if($usertype == 'Student'){
            $currentDateTime = Carbon::now('Asia/manila');
            $date = $currentDateTime->format('Y-m-d');
            $userId = Auth()->user()->id;
           
            $myLogs = Logged::where('usetId', $userId)->get();
            $numberOfLogs = $myLogs->count();

            $todayId  = 0; 
            $isClockedIn = false;
            $isTimedOut = false;
            
            if($numberOfLogs > 0){
                $firstElem = $myLogs->last();
                if ($firstElem->date == $date) {
                    $isClockedIn = true;
                }
                if($firstElem->timeOut ){
                    $isTimedOut = true;
                }
                $todayId = $firstElem->id;
            }
            
            return view('dashboard', ['logs' => $myLogs->reverse(), 'isClockedIn' => $isClockedIn, 'todayId' => $todayId, 'isTimedOut'=>$isTimedOut]);
        }
    
        else if($usertype == 'Admin'){
            $users = User::all();
            return view('admin.adminhome',  ['users' => $users]);
        }
        else if($usertype == 'Facilitator'){
            return view('facilitator.index');
        }else{
            return redirect()->back();
        }
    }
   }
}


