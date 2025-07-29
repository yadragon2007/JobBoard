<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resume extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $table = "resumes";
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        "fileName",
        "fileUri",
        "contactDetails",
        "education",
        "summary",
        "skills",
        "experience",
        "user_id"
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    protected function casts(): array
    {
        return [
            'deleted_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
