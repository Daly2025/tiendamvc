<?php

namespace Formacom\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // Tabla asociada
    protected $table = 'comments';

    // Clave primaria
    protected $primaryKey = 'id';

    // Indica si usa timestamps
    public $timestamps = false;



    // Relación: Un comentario pertenece a una tarea
    public function task()
    {
        return $this->belongsTo('Formacom\Models\Task', 'task_id', 'id');
    }

    // Relación: Un comentario pertenece a un usuario (autor)
    public function author()
    {
        return $this->belongsTo('Formacom\Models\User', 'author_id', 'id');
    }
}


?>