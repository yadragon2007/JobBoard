<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobVacancy extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $table = "job_vacancies";
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'title',
        "description",
        "location",
        "salary",
        "viewCount",
        "employment_type",
        "company_id",
        "job_category_id",
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

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function jobCategory()
    {
        return $this->belongsTo(JobCategory::class, 'job_category_id', 'id');
    }
    public function applications()
    {
        return $this->hasMany(JobApplication::class, "job_vacancy_id", "id");
    }


}
