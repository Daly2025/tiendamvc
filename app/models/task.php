<?php

namespace Formacom\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // Tabla asociada
    protected $table = 'tasks';

    // Clave primaria
    protected $primaryKey = 'id';

    // Indica si usa timestamps
    public $timestamps = true;



    // Relación: Una tarea pertenece a un proyecto
    public function project()
    {
        return $this->belongsTo('Formacom\Models\Project', 'project_id', 'id');
    }

    
}
