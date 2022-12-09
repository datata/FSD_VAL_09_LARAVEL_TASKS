<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function createTask(Request $request)
    {
        Log::info('Creating task');
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'description' => 'required',
            ]);
     
            if ($validator->fails()) {
                return response([
                    'success' => false,
                    'message' => $validator->messages()
                ], 400);
            }

            $name = $request->input('name');
            $description = $request->input('description');

            $newTask = new Task();
            $newTask->name = $name;
            $newTask->description = $description;
            $newTask->status = false;
            $newTask->save();

            return response([
                'success' => true,
                'message' => 'Task created'
            ], 200);
        } catch (\Throwable $th) {
            Log::error('Error creating task: '.$th->getMessage());

            return response([
                'success' => false,
                'message' => 'Error creating task'
            ], 500);
        }
    }

    public function getTasks()
    {
        Log::info('Getting All tasks');
        try {
            // Raw querys
            // $tasks = DB::select('select * from tasks');

            // Query Builder
            // $tasks = DB::table('tasks')->get();

            // Model
            $tasks = Task::query()->get();

            return response([
                'success' => true,
                'message' => 'All tasks retrieved successfully',
                'data' => $tasks
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response([
                'success' => false,
                'message' => 'No se han podido recuperar las tareas'
            ], 500);
        }
    }

    public function getTaskById($id)
    {
        Log::info('Getting task by id.');
        try {
            $task = Task::query()->find($id);

            if(!$task) {
                return response([
                    'success' => true,
                    'message' => 'No existe la tarea',
                ], 404);
            }

            return response([
                'success' => true,
                'message' => 'Task retrieved successfully',
                'data' => $task
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response([
                'success' => false,
                'message' => 'No se han podido recuperar la tarea'
            ], 500);
        }
    }

    public function deleteTaskById($id)
    {
        try {
            $taskId = $id;

            $task = Task::query()->find($taskId);

            if(!$task) {
                return response([
                    'success' => true,
                    'message' => 'Taks doesnt exists'
                ], 200);   
            };

            $task->delete();

            return response([
                'success' => true,
                'message' => 'Task deleted successfully'
            ], 200);            
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response([
                'success' => false,
                'message' => 'No se han podido eliminar la tarea'
            ], 500);
        }
    }

    public function updateTaskById(Request $request, $id)
    {
        try {
            $taskId = $id;

            $validator = Validator::make($request->all(), [
                'name' => 'max:255',
                'description' => 'string',
                'status' => 'boolean'
            ]);
     
            if ($validator->fails()) {
                return response([
                    'success' => false,
                    'message' => $validator->messages()
                ], 400);
            }

            $task = Task::query()->find($taskId);

            $name = $request->input('name');
            $description = $request->input('description');
            $status = $request->input('status');

            if(isset($name)) {
                $task->name = $request->input('name');
            }

            if(isset($description)) {
                $task->description = $request->input('description');
            }

            if(isset($status)) {
                $task->status = $request->input('status');
            }

            $task->save();

            return response([
                'success' => true,
                'message' => 'Task updated successfully'
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response([
                'success' => false,
                'message' => 'No se han podido actualizar la tarea'
            ], 500);
        }
    }
}
