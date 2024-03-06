<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class User extends Model implements AuthenticatableContract
{
    // Use el trait Authenticatable para permitir que este modelo sea autenticable
    use Authenticatable;
    
    // Define los campos que se pueden llenar masivamente
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Use el trait HasFactory para permitir la creación de instancias de este modelo utilizando Factories
    use HasFactory;
}
