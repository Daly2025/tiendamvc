<?php

namespace Formacom\Models; // Asegúrate de que el namespace coincide con tu estructura de carpetas

use Illuminate\Database\Eloquent\Model; // Usamos el modelo base de Eloquent

class User extends Model
{
    // Define la tabla asociada
    protected $table = 'users';

    // Define la clave primaria (opcional si sigue las convenciones de Laravel/Eloquent)
    protected $primaryKey = 'id';

    // Indica si quieres que Eloquent gestione automáticamente las columnas 'created_at' y 'updated_at'
    public $timestamps = true; // Cámbialo a 'false' si no usas estas columnas

    // Relación uno a muchos con la tabla 'projects' (corrección del nombre)
    public function projects()
    {
        return $this->hasMany('Formacom\Models\Project', 'manager_id', 'id');
    }

    // Relación uno a muchos con las tareas asignadas al usuario
    public function tasks()
    {
        return $this->hasMany('Formacom\Models\Task', 'assigned_user_id', 'id');
    }

    // Relación uno a muchos con los comentarios realizados por el usuario
    public function comments()
    {
        return $this->hasMany('Formacom\Models\Comment', 'author_id', 'id');
    }
}
