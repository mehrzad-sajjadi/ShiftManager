<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShiftRequest;
use App\Models\Shift;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShiftController extends Controller
{
    public function index(){
        
        // $shifts = Shift::where("name","صبح")->where("money",">","30")->orWhere("name","عصر")->Where("money","<","30")->get()->toArray();
        $shifts = Shift::where("name","صبح")->where("money","<",30)->orWhere(
        function ( $shift) {
            $shift->where('name', 'عصر')->where("money",">",30);}
        )->get()->toArray();


        return Inertia::render("shift/index",compact("shifts"));
    }


    public function create(){
        return Inertia::render("shift/create");
    }

    public function store(ShiftRequest $shiftRequest){
        $shift = new Shift();
        $shift->name = $shiftRequest->name ;
        $shift->start_time = $shiftRequest->start_time ;
        $shift->end_time = $shiftRequest->end_time ;
        $shift->money = $shiftRequest->money ;

        $check= Shift::whereTime("start_time","<=",$shift->start_time )->whereTime("end_time",">=",$shift->start_time)->orWhereTime("start_time",">=",$shift->start_time)->whereTime("end_time","<=",$shift->end_time)->orWhereTime("start_time","<=",$shift->end_time )->whereTime("end_time",">=",$shift->end_time)->get()->count();

        if($check>0){
            return redirect()->route("shift.create")->withErrors("Alert ! Hourly interference ");

        }else{
            $shift->save();
            return redirect()->route("shift.index")->with("message","Shift Added Successfully");
        }

    }
    public function show(Shift $shift){
        return Inertia::render("shift/show",compact("shift"));
    }


    public function delete(Shift $shift){
        $shift->delete();
        return redirect()->route("shift.index")->with("message","Shift Deleted Successfully");
    }


    public function edit(Shift $shift){
        return Inertia::render("shift/edit",compact("shift"));
    }

    public function update(ShiftRequest $shiftRequest,Shift $shift){
        $shift->name = $shiftRequest->name ;
        $shift->start_time = $shiftRequest->start_time ;
        $shift->end_time = $shiftRequest->end_time ;
        $shift->money = $shiftRequest->money ;
        $check= Shift::whereTime("start_time","<=",$shift->start_time )->whereTime("end_time",">=",$shift->start_time)->orWhereTime("start_time",">=",$shift->start_time)->whereTime("end_time","<=",$shift->end_time)->orWhereTime("start_time","<=",$shift->end_time )->whereTime("end_time",">=",$shift->end_time)->get()->count();
        if($check>0){
            return redirect()->route("shift.edit",$shift->id)->withErrors("Alert ! Hourly interference ");
        }else{
            $shift->save();
            return redirect()->route("shift.index")->with("message","Shift Edited Successfully");
        }

    }

}
