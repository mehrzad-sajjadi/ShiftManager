<?php

use App\Http\Controllers\CommuteController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShiftController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::prefix("/shift")->middleware(['auth', 'verified'])->group(function(){
    Route::get("/",                 [ShiftController::class,"index"])->name("shift.index");
    Route::get("/create",           [ShiftController::class,"create"])->name("shift.create");
    Route::post("/",                [ShiftController::class,"store"])->name("shift.store");
    Route::get("/{shift}/show",     [ShiftController::class,"show"])->name("shift.show");
    Route::delete("/{shift}/delete",[ShiftController::class,"delete"])->name("shift.delete");
    Route::get("/{shift}/edit",     [ShiftController::class,"edit"])->name("shift.edit");
    Route::put("/{shift}/update",   [ShiftController::class,"update"])->name("shift.update"); 
});


Route::prefix("/employee")->middleware(['auth', 'verified'])->group(function(){
    Route::get("/",                     [EmployeeController::class,"index"])->name("employee.index");
    Route::get("/create",               [EmployeeController::class,"create"])->name("employee.create");
    Route::post("/",                    [EmployeeController::class,"store"])->name("employee.store");
    Route::get("/{employee}/show",      [EmployeeController::class,"show"])->name("employee.show");
    Route::delete("/{employee}/delete", [EmployeeController::class,"delete"])->name("employee.delete");
    Route::get("/{employee}/edit",      [ EmployeeController::class,"edit"])->name("employee.edit");
    Route::put("/{employee}/update",    [EmployeeController::class,"update"])->name("employee.update");
});

Route::prefix("/commute")->middleware(['auth', 'verified'])->group(function(){
    Route::get("/",                     [CommuteController::class,"index"])->name("commute.index");
    Route::get("/create",               [CommuteController::class,"create"])->name("commute.create");
    Route::post("/",                    [CommuteController::class,"store"])->name("commute.store");
    Route::delete("/{commute}/delete",  [CommuteController::class,"delete"])->name("commute.delete");
    Route::get("/money",                [CommuteController::class,"money"])->name("commute.money");

});






Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
