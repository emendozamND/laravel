<?php
use Illuminate\Http\Response;
//use Symfony\Component\HttpFoundation\Response;
use App\Models\Task;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;



 Route::get('/', function () {
    return redirect()->route('tasks.index');
}); 

//LISTAR
Route::get('/tasks', function (){
    return view('index', [
        
        'tasks' => \App\Models\Task::latest()->get()
    ]);
})->name('tasks.index');

//CREAR FORMULARIO
Route::view('/tasks/create','create')
    ->name('tasks.create');


//EDITAR FORMULARIO
    Route::get('/tasks/{id}/edit',function ($id) {
    return view('edit', [
        'task'=> Task::findOrFail($id)
    ]);
})->name('tasks.edit');


//MOSTRAR DETALLE
    Route::get('/tasks/{id}',function ($id) {
    return view('show', ['task'=>Task::findOrFail($id)]);
})->name('tasks.show');

//GUARDAR NUEVA TAREA 
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

// ACTUALIZAR TAREA EXISTENTE
Route::put('/tasks/{id}', function ($id, Request $request) {
    $data = $request->validate([
        'title'            => 'required|max:255',
        'description'      => 'required',
        'long_description' => 'required',
    ]);

    $task = Task::findOrFail($id);
    $task->title            = $data['title'];
    $task->description      = $data['description'];
    $task->long_description = $data['long_description'];
    $task->save();

    return redirect()
        ->route('tasks.show', ['id' => $task->id])
        ->with('success', 'Task updated successfully!');
})->name('tasks.update'); // 👈 ESTE ES EL NOMBRE QUE FALTABA
