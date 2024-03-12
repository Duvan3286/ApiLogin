<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class Person extends Model
{
    // Use el trait Authenticatable para permitir que este modelo sea autenticable
    protected $table = 'person';
    public $timestamps = false;
    // Define los campos que se pueden llenar masivamente
    protected $fillable = [
        'identification',
        'name',
        'lastname',
        'type_person_id',
        'job',
        'destination',
        'address',
        'phone',
        'email',
        'reason'
    ];

    // Use el trait HasFactory para permitir la creación de instancias de este modelo utilizando Factories
    //use HasFactory;
}
