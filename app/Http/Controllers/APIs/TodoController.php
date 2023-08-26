<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Http\JsonResponse;

class TodoController extends Controller
{
    protected int $itemPerPage = 10;

    public function index(): JsonResponse
    {
        $todos = Todo::orderByDesc('created_at', 'desc')
            ->paginate($this->itemPerPage);

        return response()->json([
            'data' => $todos,
            'msg' => __('Todos list'),
        ]);
    }

    public function store(TodoRequest $request): JsonResponse
    {
        $data = $request->validated();

        $todo = Todo::create([
            'name' => $data['name'],
            'content' => $data['content'],
        ]);

        return response()->json([
            'data' => $todo,
            'msg' => __('Create success'),
        ]);
    }

    public function update(TodoRequest $request, string|int $id): JsonResponse
    {
        $data = $request->validated();

        $todo = Todo::find($id);

        if(! $todo) {
            return response()->json([
                'msg' => __('Todo not found'),
            ]);
        }

        $todo->update([
            'name' => $data['name'],
            'content' => $data['content'],
        ]);

        return response()->json([
            'data' => $todo,
            'msg' => __('Update success')
        ]);
    }

    public function delete(string|int $id): JsonResponse
    {
        $todo = Todo::find($id);

        if(! $todo) {
            return response()->json([
                'msg' => __('Todo not found'),
            ]);
        }

        $todo->delete();

        return response()->json([
            'msg' => __('Delete success'),
        ]);
    }
}
