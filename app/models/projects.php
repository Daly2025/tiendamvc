<?php

namespace Formacom\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    // Tabla asociada
    protected $table = 'projects';

    // Clave primaria
    protected $primaryKey = 'id';

    // Indica si usa timestamps
    public $timestamps = false;


    // Relación: Un proyecto pertenece a un gestor (usuario)
    public function manager()
    {
        return $this->belongsTo('Formacom\Models\User', 'manager_id', 'id');
    }

    // Relación: Un proyecto tiene muchas tareas
    public function tasks()
    {
        return $this->hasMany('Formacom\Models\Task', 'project_id', 'id');
    }
}
