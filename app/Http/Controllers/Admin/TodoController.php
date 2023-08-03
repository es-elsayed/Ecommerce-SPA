<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TodoRequest;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;

class TodoController extends Controller
{
    private string $routeResourceName = 'todos';

    public function index(Request $request)
    {
        $todo = Todo::query()
            ->select(['id', 'title', 'description', 'completed_at', 'created_at'])
            ->when($request->search, fn(Builder $builder, $search) => $builder->where('name', 'like', "%{$search}%"))
            ->orderBy('created_at', 'asc')
            ->paginate(20);

        return Inertia::render('Todo/Index', [
            'title' => 'Todos',
            'items' => TodoResource::collection($todo),
            'headers' => [
                [
                    'label' => '#',
                    'name' => 'completed_at',
                ],
                [
                    'label' => 'Title',
                    'name' => 'title',
                ],
                [
                    'label' => 'Description',
                    'name' => 'description',
                ],
                [
                    'label' => 'Created At',
                    'name' => 'created_at',
                ],
                [
                    'label' => 'Actions',
                    'name' => 'actions',
                ],
            ],
            'routeResourceName' => $this->routeResourceName,
            'filters' => (object) $request->all(),
        ]);

    }

    public function create()
    {
        return Inertia::render('Todo/Create', [
            'action' => 'create',
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    public function store(TodoRequest $request)
    {
        Todo::create($request->validated());
        return redirect()->route('admin.todos.index')->with('success', 'Todo Created Successfully');
    }
    public function edit(Todo $todo)
    {
        return Inertia::render('Todo/Create', [
            'item' => new TodoResource($todo),
            'action' => 'edit',
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    public function update(TodoRequest $todoRequest, Todo $todo)
    {
        $todo->update($todoRequest->validated());
        return redirect()->route('admin.todos.index')->with('success', 'Todo Updated Successfully');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('admin.todos.index')->with('error', 'Todo Deleted Successfully');
    }
}
