<?php
namespace Formacom\controllers;
use Formacom\Core\Controller;


class MainController extends Controller{
    public function index(...$params){

        $this->view('home');
    }
    
   
}
?>