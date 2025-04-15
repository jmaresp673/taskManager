<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'color_code',
        'description',
        'parent_id',
        'position',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (static::where('name', $category->name)->exists()) {
                throw new \Exception("Category name must be unique.");
            }
            $category->position = Category::max('position') + 1;
        });
    }

    /**
     * Get the parent category, as a Category object can have a parent category
     */
    public function parent(): ?Category
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Get the children of the category
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Get the tasks of the category
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Get the attachments of the task
     */
    public function taskAttachments()
    {
        return $this->hasMany(TaskAttachment::class);
    }

    /**
     * Get the tasks count of the category
     */
    public function tasksCount()
    {
        return $this->tasks()->count();
    }

    /**
     * Get the completed tasks of the category
     */
    public function tasksCompletedCount()
    {
        return $this->tasks()->where('completed', true)->count();
    }

    /**
     * Get the completed percentage tasks of the category
     */
    public function tasksCompletedPercentage()
    {
        $tasksCount = $this->tasksCount();
        if ($tasksCount === 0) {
            return 0;
        }
        return $this->tasksCompletedCount() / $tasksCount * 100;
    }

    public static function reorderCategories(array $orderedIds)
    {
        foreach ($orderedIds as $index => $id) {
            static::where('id', $id)->update(['position' => $index]);
        }
    }
}
