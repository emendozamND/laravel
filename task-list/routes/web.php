<?php
use Illuminate\Http\Response;
//use Symfony\Component\HttpFoundation\Response;
use App\Models\Task;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;



 Route::get('/', function () {
    return redirect()->route('tasks.index');
}); 
Route::get('/tasks', function (){
    return view('index', [
        //'tasks' => \App\Models\Task::all()
        //'tasks' => \App\Models\Task::latest()->where('completed', false)->get()
        'tasks' => \App\Models\Task::latest()->get()
    ]);
})->name('tasks.index');


Route::view('/tasks/create','create')
    ->name('tasks.create');

Route::get('/tasks/{id}/edit',function ($id) {
    return view('edit', ['task'=> \App\Models\Task::findOrFail($id)
    ]);
})->name('tasks.edit');



    Route::get('/tasks/{id}',function ($id) {
    return view('show', ['task'=> \App\Models\Task::findOrFail($id)]);
})->name('tasks.show');

Route::post('/tasks', function(Request $request) {
    //dd($request->all());
    $data= $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description'=>'required'
    ]);
    $task = new Task;
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];
    $task->save();
    return redirect()->route('tasks.show',['id'=>$task->id])
    ->with('success', 'Task created successfully!');

})->name('tasks.store');
