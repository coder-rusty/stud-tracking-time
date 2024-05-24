<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Logged;
use App\Models\User;

class LoggedController extends Controller
{
    public function index()
    {
        $logs = Logged::all()->reverse();
        $usernames = []; 
    
        foreach ($logs as $log) {
            $user = User::find($log->userId);
            if ($user) {
                $usernames[$log->id] = $user->name;
            }
        }
    
        return view('admin.logs', ['logs' => $logs, 'usernames' => $usernames]);
    }
    
    public function create(Request $request){
        
        $userId = Auth::id();

        $currentDateTime = Carbon::now('Asia/manila');
      
        $date = $currentDateTime->format('Y-m-d');

        $timeIn = $currentDateTime->format('H:i:s');
       
        Logged::create([
            'usetId' => $userId,
            'date' => $date,
            'timeIn' => $timeIn,
            'timeOut' => "",
        ]);

        return redirect(route('admin.index'));
    }

    public function update(Logged $logs){    
        $currentDateTime = Carbon::now('Asia/manila');
        $timeOut = $currentDateTime->format('H:i:s');

        $logs->update([
            "timeOut" => $timeOut 
        ]);

        return redirect(route('admin.index'));
    }



  
}
