<?php

namespace App\Models;

use App\Enums\Day;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commute extends Model
{
    use HasFactory;

    protected $fillable = [
        "enter",
        "exit",
        "day",
        "employee_id",
    ];
    

    public $appends=["employee_name","salary"];


    public function employee(){
        return $this->belongsTo(Employee::class,);
    }


    public function getEmployeeNameAttribute(){
        return $this->employee->name;
    }



    public function getSalaryAttribute(){
        $shifts = Shift::all(); 
        $enter = Carbon::createFromFormat("H:i:s", $this->enter);
        $exit = Carbon::createFromFormat("H:i:s", $this->exit);

        $matchShifts = [];

        if ($exit < $enter) {
            $exit = $exit->addDay();
        }

        foreach ($shifts as $shift) {
            $startShift = Carbon::createFromFormat("H:i:s", $shift->start_time);
            $endShift = Carbon::createFromFormat("H:i:s", $shift->end_time);

            if ($endShift < $startShift) {
                $endShift = $endShift->addDay();
            }

            $startWork = $enter->max($startShift);
            $endWork = $exit->min($endShift);

            if ($startWork < $endWork) {
                $timeWork = $startWork->diffInHours($endWork);
                $salary = $timeWork * $shift->money;
                $matchShifts[] = [
                    'salary' => $salary,
                ];
            }
        }
 
        $totalSalary = 0;

        foreach ($matchShifts as $val) {
            $totalSalary = $totalSalary + $val['salary'];
        }
        return $totalSalary;
    }


}
