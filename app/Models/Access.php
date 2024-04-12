<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    protected $table = 'access'; 
    public $timestamps = false;

    protected $fillable = [
        'idPerson', 'entrada', 
    ];

    // Define la relación con el modelo Person
    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
