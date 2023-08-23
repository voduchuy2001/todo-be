<?php

namespace App\Http\Controllers\APIs;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Http\JsonResponse;

class TodoController extends BaseController
{
    protected int $itemPerPage = 10;

    public function index(): JsonResponse
    {
        $todos = Todo::orderByDesc('created_at', 'desc')->paginate($this->itemPerPage);

        return $this->success($todos, __('Todos list'));
    }

    public function store(TodoRequest $request): JsonResponse
    {
        $data = $request->validated();

        $todo = Todo::create([
            'name' => $data['name'],
            'content' => $data['content'],
        ]);

        return $this->success($todo, __('Create success'));
    }

    public function update(TodoRequest $request, string|int $id): JsonResponse
    {
        $data = $request->validated();

        $todo = Todo::find($id);

        if(! $todo) {
            return $this->error('Todo not found');
        }

        $todo->update([
            'name' => $data['name'],
            'content' => $data['content'],
        ]);

        return $this->success($todo, __('Update success'));
    }

    public function delete(string|int $id): JsonResponse
    {

        $todo = Todo::findOrFail($id);

        $todo->delete();

        return $this->success($todo->name, __('Delete success'));
    }
}
