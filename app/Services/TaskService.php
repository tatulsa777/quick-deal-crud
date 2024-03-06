<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskService
{
    const TASK_COUNT = 12;

    /**
     * @param array $data
     * @return LengthAwarePaginator
     */
    public function filter(array $data): LengthAwarePaginator
    {
        return Task::query()
            ->orderByDesc('id')
            ->when(array_key_exists('status', $data), function ($q) use ($data) {
                return $q->where('status', $data['status']);
            })
            ->when(array_key_exists('date', $data), function ($q) use ($data) {
                return $q->whereDate('created_at', $data['date']);
            })
            ->paginate($data['per_page'] ?? self::TASK_COUNT);
    }

    /**
     * @param array $data
     * @return Task
     */
    public function create(array $data): Task
    {
        return Task::create($data);
    }

    /**
     * @param array $data
     * @param Task $task
     * @return void
     */
    public function update(array $data, Task $task): void
    {
        $task->update($data);
    }

    /**
     * @param Task $task
     * @return void
     */
    public function delete(Task $task): void
    {
        $task->delete();
    }
}
