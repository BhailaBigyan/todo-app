<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::orderBy('created_at', 'desc')->get();
        return view('todos.index', compact('todos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|max:255'
        ]);

        Todo::create([
            'task' => $request->task,
            'completed' => false
        ]);

        return redirect()->back();
    }

    public function toggle($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->completed = !$todo->completed;
        $todo->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        Todo::findOrFail($id)->delete();
        return redirect()->back();
    }
} 