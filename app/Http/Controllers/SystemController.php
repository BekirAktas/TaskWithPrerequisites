<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\AddPrerequisiteRequest;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Prerequisite;
use App\Models\CustomOps;
use App\Models\InvoiceOps;
use App\Http\Resources\TaskResource;
use App\Http\Resources\OrderTasksResource;


class SystemController extends Controller
{
    public function create(CreateTaskRequest $request) {
        $task = new Task;
        $task->title = $request->get('title');
        $task->type = $request->get('type');
        $task->save();

        if ($request->get('type') === 'invoice_ops') {
            $invoinceOps = new InvoiceOps();
            $invoinceOps->task_id = $task->id;
            $invoinceOps->currency = $request->get('amount')['currency'];
            $invoinceOps->quantity = $request->get('amount')['quantity'];
            $invoinceOps->save();
        } elseif ($request->get('type') === 'custom_ops') {
            $customOps = new CustomOps;
            $customOps->task_id = $task->id;
            $customOps->country = $request->get('country');
            $customOps->save();
        }
    }

    public function addPrerequisite(AddPrerequisiteRequest $request, $taskId) {
        if (in_array($taskId, $request->get('prerequisite_task_id'))) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tasks cannot be own prerequisites'
            ], 401);
        }

        foreach ($request->get('prerequisite_task_id') as $prerequisite) {
            Prerequisite::updateOrCreate(
                ['task_id' => $taskId, 
                'prerequisite_task_id' =>  $prerequisite],
                ['task_id' => $taskId,
                'prerequisite_task_id' =>  $prerequisite]
            );
        }
    }

    public function getAllTasks(){
        $tasks = Task::with('prerequisites')->get();

        return TaskResource::collection($tasks);
    }

    public function orderTasks() {
        $tasks = Task::with('prerequisites')
        ->get()
        ->mapWithKeys(function($item, $key) {
            return [$item->id => $item];
        });

        $taskArray = [];

        foreach ($tasks as $i=>$tmp)
        {
            array_push($taskArray, $this->orderAndCheckTasks($tasks, $i));
        }

        $sortedTasks = $tasks->toArray();

        if (!in_array(-1, $taskArray))
        {
            array_multisort($taskArray, SORT_ASC, $sortedTasks);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Tasks cannot be sorted due to an infinite loop.'
            ], 401);
        }

        return response(OrderTasksResource::collection($sortedTasks));
    }

    public function orderAndCheckTasks($taskArr, $taskId, $ref = [])
    {
        if (count($taskArr[$taskId]->prerequisites) === 0) { 
            return 0; 
        }
        
        if (in_array($taskId, $ref)) { 
            return -1; 
        }

        array_push($ref, $taskId);
        $response = $this->orderAndCheckTasks($taskArr, $taskArr[$taskId]->prerequisites[0]['prerequisite_task_id'], $ref);

        return ($response == -1 ? -1 : $response + 1);
    }
}