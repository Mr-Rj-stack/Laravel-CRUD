<?php

use App\Events\popupMessage;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\userController;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});






Route::get('/dashboard', function () {
    $tasks=Task::where('user_id','=',Auth::id())->get();
    return view('dashboard',compact('tasks'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware('auth')->group(function () {
//routes for create and store new tasks
Route::get('/newtask',[TaskController::class,'newtask'])->name('task.view');
Route::post('/create_task/{id}',[TaskController::class,'create'])->name('task.post');

//route for view all posted tasks
Route::get('/all_tasks',[TaskController::class,'view_all_tasks'])->name('all_tasks');

//route for view perticular task
Route::get('/view_tasks/{task}',[TaskController::class,'view'])->name('view');

//route for update task
Route::get('/update_task/{task}',[TaskController::class,'update_task'])->name('task.update');
Route::put('/update_post/{task}',[TaskController::class,'update'])->name('task.update.post');

//route for delete task
Route::delete('/delete/{task}',[TaskController::class,'destroy'])->name('delete');

});
