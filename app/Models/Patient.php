<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use hasFactory;
    protected $fillable = [
        'name',
        'email',
        'address',
        'phone',
        'document_photo'
    ];
}
