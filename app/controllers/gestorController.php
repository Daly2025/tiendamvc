<?php

namespace Formacom\controllers;
use Formacom\Core\Controller;


class GestorController extends Controller{
    public function index(...$params){

        $this->view('home');
    }
    
   
}
?>