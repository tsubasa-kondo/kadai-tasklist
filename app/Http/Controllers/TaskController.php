<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Task;
class TaskController extends Controller
{
    // getでtasks/にアクセスされた場合の「一覧表示処理」
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);
            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];
            //$data += $this->counts($user);
            return view('tasks.index', $data);
        }else {
            return view('welcome');
        }
    }
    // getでtasks/createにアクセスされた場合の「新規登録画面表示処理」
    public function create()
    {
        if (\Auth::check()) {
            $task = new Task;
    
            return view('tasks.create', [
                'task' => $task,
            ]);
        }else {
            return view('welcome');
        }
    }
    // postでtasks/にアクセスされた場合の「新規登録処理」
    public function store(Request $request)
    {
        if (\Auth::check()) {
            $this->validate($request, [
                'status' => 'required|max:10',
                'content' => 'required|max:191',
            ]);
    
            $task = new Task;
        $task->status = $request->status;    
        $task->content = $request->content;
        $task->user_id = $request->user()->id;
        $task->save();
            
    
            return redirect('/');
        }else {
            return view('welcome');
        }
    }
    // getでtasks/idにアクセスされた場合の「取得表示処理」
    public function show($id)
    {
        $task = Task::find($id);
        if (\Auth::id() === $task->user_id) {
    
            return view('tasks.show', [
                'task' => $task,
            ]);
        }else {
            return redirect('/');
        }
    }
    // getでtasks/id/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        $task = Task::find($id);
        if (\Auth::id() === $task->user_id) {
    
            return view('tasks.edit', [
                'task' => $task,
            ]);
        }else {
            return redirect('/');
        }
    }
    // putまたはpatchでtasks/idにアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        if (\Auth::check()) {
            $user = \Auth::user();
            $this->validate($request, [
                'status' => 'required|max:10',
                'content' => 'required|max:191',
            ]);
    
            $task = Task::find($id);
            $task->status = $request->status;
            $task->content = $request->content;
            $task->user_id = $request->user()->id;
            $task->save();
    
            return redirect('/');
        }else {
            return view('welcome');
        }
    }
    // deleteでtasks/idにアクセスされた場合の「削除処理」
    public function destroy($id)
    {
        if (\Auth::check()) {
            $task = Task::find($id);
    
             if (\Auth::id() === $task->user_id) {
                $task->delete();
             }
    
            return redirect('/');
        }else {
            return view('welcome');
        }
    }
}