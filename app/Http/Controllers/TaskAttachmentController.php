<?php

namespace App\Http\Controllers;

use App\Models\TaskAttachment;
use Illuminate\Http\Request;

class TaskAttachmentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'file_name' => 'required|string|max:255',
            'file_path' => 'required|string',
            'file_size' => 'required|integer|max:5120',
        ]);

        $taskAttachment = TaskAttachment::create([
            'task_id' => $request->task_id,
            'file_name' => $request->file_name,
            'file_path' => $request->file_path,
            'file_size' => $request->file_size,
        ]);

        return response()->json([
            'message' => 'Attachment created successfully',
            'taskAttachment' => $taskAttachment,
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskAttachment $taskAttachment)
    {
        $taskAttachment->delete();

        return response()->json([
            'message' => 'Attachment deleted successfully',
        ], 200);
    }
}
