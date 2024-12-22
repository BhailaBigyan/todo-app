<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Todo App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-700 min-h-screen p-8">
    <div class="max-w-2xl mx-auto bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-6 text-white">Todo App</h1>

        <!-- Add Todo Form -->
        <form action="{{ route('todos.store') }}" method="POST" class="mb-6">
            @csrf
            <div class="flex gap-2">
                <textarea 
                    name="task" 
                    placeholder="What do you need to do today?"
                    class="flex-1 p-2 rounded bg-gray-700 text-white placeholder-gray-400 border border-gray-600 focus:outline-none focus:border-blue-500"
                    rows="1"
                ></textarea>
                <button 
                    type="submit"
                    class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none"
                >
                    ADD
                </button>
            </div>
        </form>

        <!-- Todo List -->
        <div class="space-y-3">
            @foreach($todos as $todo)
                <div class="flex items-center justify-between gap-4 p-4 bg-gray-700 rounded group">
                    <div class="flex items-center gap-4">
                        <form action="{{ route('todos.toggle', $todo->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="flex items-center">
                                <div class="w-6 h-6 border-2 rounded {{ $todo->completed ? 'bg-blue-500 border-blue-500' : 'border-gray-400' }} flex items-center justify-center">
                                    @if($todo->completed)
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    @endif
                                </div>
                            </button>
                        </form>
                        <span class="text-white/50 {{ $todo->completed ? 'line-through' : '' }}">
                            {{ $todo->task }}
                        </span>
                    </div>
                    
                    <form action="{{ route('todos.destroy', $todo->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-blue-500 opacity-0 group-hover:opacity-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html> 