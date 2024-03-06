<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUpdateTaskRequest;
use App\Http\Requests\FilterTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    /**
     * @param TaskService $service
     */
    public function __construct(protected TaskService $service) {}

    /**
     * @param FilterTaskRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(FilterTaskRequest $request): AnonymousResourceCollection
    {
        return TaskResource::collection($this->service->filter($request->validated()));
    }

    /**
     * @param CreateUpdateTaskRequest $request
     * @return TaskResource
     */
    public function store(CreateUpdateTaskRequest $request): TaskResource
    {
        return TaskResource::make($this->service->create($request->validated()));
    }

    /**
     * @param Task $task
     * @return TaskResource
     */
    public function show(Task $task): TaskResource
    {
        return TaskResource::make($task);
    }

    /**
     * @param CreateUpdateTaskRequest $request
     * @param Task $task
     * @return Response
     */
    public function update(CreateUpdateTaskRequest $request, Task $task): Response
    {
        $this->service->update($request->validated(), $task);

        return response()->noContent();
    }

    /**
     * @param Task $task
     * @return Response
     */
    public function destroy(Task $task): Response
    {
        $this->service->delete($task);

        return response()->noContent();
    }
}
