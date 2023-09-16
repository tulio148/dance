<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Classes extends Model
{
    use HasFactory;

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'name', "description", "style", 'level', 'instructor', 'enrollment_mode', 'datetime', 'location', 'price'
    ];

    protected $casts = [
        'datetime' => 'datetime',
        'price' => 'decimal:2'
    ];

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'class_student', 'class_id', 'student_id');
    }
}
