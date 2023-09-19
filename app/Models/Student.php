<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
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


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'user_id'
    ];

    /**
     * Define a belongs to relationship with the User model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(Classes::class, 'class_student', 'student_id', 'class_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Orders::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'student_id', 'id');
    }
}
