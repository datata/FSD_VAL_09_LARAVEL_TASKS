<?php

namespace App\Http\Controllers;

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
            $tasks = DB::select('select * from tasks');

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
}
