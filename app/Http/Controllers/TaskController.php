<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use App\Models\TaskAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     * Sorting (by creation date, due date, priority)
     * Filters (completed/incomplete, category, priority, due date)
     * Search function
     */
    public function index(Request $request)
    {
        // Validation of parameters
        $request->validate([
            'search' => 'nullable|string|max:255',
            'status' => 'nullable|in:completed,incomplete',
            'priority' => 'nullable|in:low,medium,high,urgent',
            'category_id' => 'nullable|exists:categories,id',
            'due_date' => 'nullable|date',
            'sort_by' => 'nullable|in:title,due_date,created_at,priority,category_id',
            'sort_direction' => 'nullable|in:asc,desc',
        ]);

        $query = Task::query()->with('category', 'user');

        // Search by title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('due_date')) {
            $query->whereDate('due_date', $request->due_date);
        }

        // Order By
        if ($request->filled('sort_by')) {
            $query->orderBy($request->sort_by, $request->get('sort_direction', 'asc'));
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Pagination
        $tasks = $query->SimplePaginate(10);
        $categories = Category::all();

        return view('tasks.index', compact('tasks', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('tasks.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100|min:5',
            'description' => 'nullable|string|max:500',
            'due_date' => 'required|date',
            'priority' => 'required|in:low,medium,high,urgent',
            'status' => 'nullable|in:completed,incomplete',
            'category_id' => 'required|exists:categories,id',
            'task_attachment' => 'nullable|array|max:5',
            'task_attachment.*' => 'file|max:5120', // (5MB)
        ]);

        $request->merge(['user_id' => auth()->id()]);

        $task = Task::create($request->all());

        // Store the files
        if ($request->hasFile('task_attachment')) {
            foreach ($request->file('task_attachment') as $file) {
                $fileName = $file->getClientOriginalName();
                $uniqueName = time() . '_' . $fileName;
                $file->storeAs('attachments', $uniqueName, 'public');

                TaskAttachment::create([
                    'task_id' => $task->id,
                    'file_name' => $fileName,
                    'file_path' => $uniqueName,
                    'file_size' => $file->getSize(),
                ]);
            }
        }

        return redirect()->route('tasks.index')->with('success', 'Task created.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        // Check if task is not deleted
        if ($task->trashed()) {
            return redirect()->route('tasks.index')->with('error', 'Task not found.');
        }

        // Load the task with taskAttachments and TaskComments
        $task->load('taskAttachment');

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->taskAttachment()->delete(); // soft delete the attachments
        $task->delete(); // soft delete the task

        return redirect()->route('tasks.index')->with('success', 'Task deleted.');
    }

    /**
     * Show trashed tasks
     */
    public function trashed()
    {
        $tasks = Task::onlyTrashed()->with('category', 'taskAttachment')->paginate(10);

        return view('tasks.trashed', compact('tasks'));
    }

    /**
     * Restore deleted task
     */
    public function restore($id)
    {
        $task = Task::onlyTrashed()->with('taskAttachment')->findOrFail($id);
        $task->restore();

        $task->taskAttachment()->withTrashed()->restore();

        return redirect()->route('tasks.index')->with('success', 'Task restored.');
    }

    /**
     * Update task status
     */
    public function updateStatus(Request $request, $id)
    {
        // Status validation
        $request->validate([
            'status' => 'required|in:completed,incomplete',
        ]);

        // Find the task
        $task = Task::findOrFail($id);

        // Status update
        $task->status = $request->status;
        $task->save();

        return redirect()->back()->with('success', 'Task status updated.');
    }

}
