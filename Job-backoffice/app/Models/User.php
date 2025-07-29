<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasUuids, SoftDeletes;
    protected $table = "users";
    protected $keyType = "string";
    public $incrementing = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        "role",
    ];
    protected $dates = [
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'email_verified_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }
    public function companies()
    {
        return $this->hasMany(Company::class, 'owner_id', 'id');
    }
    public function jobApplications()
    {
        return $this->hasMany(jobApplication::class, 'user_id', 'id');
    }
    public function resumes()
    {
        return $this->hasMany(Resume::class, 'user_id', 'id');
    }
}
