<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\SubTask;
use Illuminate\Support\Facades\Auth;
use Image;


class TaskController extends Controller
{
    public function getTask(){
        return response()->json(Task::latest()->with('sub_task')->get());
    }
    public function storeTask(Request $request){
        if ($request->task_file) {
            $task_file = time() . '.' . explode('/', explode(':', substr($request->task_file, 0, strpos($request->task_file, ';')))[1])[1];
            Image::make($request->task_file)->save(public_path('img/tasks/' . $task_file));
        }else{
            $task_file = null;
        }
        Task::create([
            'title'     => $request->title,
            'date'      => $request->date,
            'time'      => $request->time,
            'detail'    => $request->detail,
            'task_file' => $task_file,
        ]);
        return response()->json("create successfully");
    }//end store task
    public function updateTask(Request $request, $id){
        Task::where('id',$id)->update([
            'title'     => $request->title,
            'date'      => $request->date,
            'time'      => $request->time,
            'detail'    => $request->detail,
        ]);
        return response()->json("create successfully");
    }

    public function removeTask(Request $request,$id){
        //return response()->json("hello");
        Task::where('id',$id)->delete();
        return response()->json("deleting successfully");
    }

    public function storeSubTask(Request $request){
        //return response()->json('hi from controller');
        $subTasks = $request->all();
        foreach($subTasks as $subTask){
            SubTask::create([
                'task_id'       => $subTask['task_id'],
                'title'         => $subTask['title'],
                'status'        => 0,
                'detail'        => $subTask['detail'],
                'start_date'    => $subTask['start_date'],
                'end_date'      => $subTask['end_date'],

            ]);
        }
        return response()->json('Adding Successfully');
    }
    public function getTaskDataToUpdate($id){
        return response()->json(Task::where('id',$id)->first());
    }

    public function getSubTasksData($id){
        return response()->json(SubTask::where('task_id',$id)->get());
    }

    public function updateSubTask(Request $request, $id){

        SubTask::where('id',$id)->update([
            'title'         => $request->title,
            'detail'        => $request->detail,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,

        ]);
        return response()->json("Update successfully");
    }
    public function deleteSubTask($id)
    {
        SubTask::where('id',$id)->delete();
        return response()->json("deleting successfully");
    }
    public function markSubTaskAsComplate($id){
        SubTask::where('id',$id)->update([
            'status'=> 1
        ]);
        return response()->json("Update Status successfully");
    }
    public function markSubTaskAsInComplate($id){
        SubTask::where('id',$id)->update([
            'status'=> 0
        ]);
        return response()->json("Update Status successfully");
    }

    public function logout(Request $request) {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
