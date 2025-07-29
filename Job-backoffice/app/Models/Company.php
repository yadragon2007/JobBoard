<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory,HasUuids, SoftDeletes;
    protected $table = "companies";
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['name',"location","industry","website","owner_id"];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    protected function casts(): array
    {
        return [           
            'deleted_at' => 'datetime',
        ];
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id','id');
    }
    public function jobVacancies()
    {
        return $this->hasMany(JobVacancy::class, 'company_id', 'id');
    }
}
