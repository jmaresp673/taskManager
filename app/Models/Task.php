<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'priority',
        'status',
        'user_id',
        'category_id',
    ];

    protected $casts = [
        'due_date' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function taskAttachment()
    {
        return $this->hasMany(TaskAttachment::class);
    }

    public function taskComment()
    {
        return $this->hasMany(TaskComment::class)->orderBy('created_at', 'desc');
    }

    public function taskHistory()
    {
        return $this->hasMany(TaskHistory::class);
    }

    protected static function booted()
    {
        static::deleting(function ($task) {
            foreach ($task->taskAttachment as $attachment) {
                // removes the file from the storage when deleting the task
                \Storage::disk('public')->delete($attachment->file_path);

                // Deletes from DB
                $attachment->delete();
            }
        });
    }

}
