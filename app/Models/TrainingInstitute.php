<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingInstitute extends Model
{
    use HasFactory;
    protected $table = 'training_institutes';

     protected $fillable = [
        'user_id',
        'name',
        'website',
        'address',
        'phone',
        'email',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
