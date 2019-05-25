<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);
            
            $data = [
                
                'tasks' => $tasks,
            ];
            return view('tasks.index',[
            'tasks' => $tasks,
            ]);
        }
        
        return view('welcome', $data);
    
        $tasks = Task::all();
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         if (\Auth::check()) {
            $user = \Auth::user();
        $task = new Task;
        
        return view('tasks.create',[
            'task' => $task,
            ]);
         }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'content' => 'required|max:191',
        'status' => 'required|max:10',
        ]);
        
        if (\Auth::check()) {
            $user = \Auth::user();
            
        $task = new Task;
        $task->status = $request->status;
        $task->content = $request->content;
        $task->user_id = $user->id;
        $task->save();
        }
        
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
    public function show($id)
    {
        
         if (\Auth::check()) {
            $user = \Auth::user();
        $task = Task::find($id);
        
        return view('tasks.show',[
            'task' => $task,
            ]);
         }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        
        return view('tasks.edit',[
            'task' => $task,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         if (\Auth::check()) {
            $user = \Auth::user();
        $this->validate($request, [
        'content' => 'required|max:191',
        'status' => 'required|max:10',
        ]);
        
        $task = Task::find($id);
        $task->status = $request->status;
        $task->content = $request->content;
        $task->save();
        
        return redirect('/');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = \App\Task::find($id);

        if (\Auth::id() === $task->user_id) {
            $task->delete();
        }
        
        return back();
    }
}
