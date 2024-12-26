<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

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
    }

    /**
     * complete Task
     */

    protected function setCompleteTaskAttribute($value)
    {
        $this->attributes['completed'] = $value;
    }
}
