<?php

namespace App\Http\Controllers;

use App\Enums\Day;
use App\Http\Requests\CommuteRequest;
use App\Models\Commute;
use App\Models\Employee;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CommuteController extends Controller
{

    public function index(){
        $commutes = Commute::all();
        return Inertia::render("commute/index",compact("commutes"));
    }

    public function create(){
        $employees = Employee::all();
        $days = Day::cases();
        return Inertia::render("commute/create",compact("employees","days"));
    }


    public function store(CommuteRequest $commuteRequest){
        $commute = new Commute();
        $commute->enter = $commuteRequest->enter;
        $commute->exit = $commuteRequest->exit;
        $commute->employee_id = $commuteRequest->employee_id;
        $commute->day = $commuteRequest->day;
        $check = Commute::where("employee_id",$commute->employee_id )->where("day",$commute->day)->first();
        if($check){
            return redirect()->route("commute.create")->withErrors("ورود این کارمند در این روز قبلا ثبت شده");
        }else{
            $commute->save();
            return redirect()->route("commute.index");            
        }
        
    }

    public function money(){
        $commute = Commute::first()->toArray();
        $shift = Shift::first();
        $start = $shift->start_time ;
        $end =  $shift->end_time;
        $start = Carbon::createFromFormat("H:i:s",$start );
        $end = Carbon::createFromFormat("H:i:s",$end );
    }
    
    public function delete(Commute $commute){
        $commute->delete();
        return redirect()->route("commute.index")->with("message","Commute deleted Successfully");
    }


}
