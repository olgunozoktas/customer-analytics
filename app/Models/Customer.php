<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];

    protected $fillable = [
        'name',
        'email',
        'gsm_no',
        'department_id',
        'birthday'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
