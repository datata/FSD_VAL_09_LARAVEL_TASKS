<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function createTask()
    {
        return 'create tasks';
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
}
