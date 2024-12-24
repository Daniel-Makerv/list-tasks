<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'completed',
        'completed_at',
    ];




    public function files()
    {
        return $this->hasMany(TaskFile::class);
        // return $this->hasMany(TaskFile::class, 'task_id');
    }
}
