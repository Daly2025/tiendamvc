<?php
namespace Formacom\controllers;
use Formacom\Core\Controller;
use Formacom\Models\Customer;
use Formacom\Models\Address;

class CustomerController extends Controller{
    public function index(...$params){
    
        $data = ['mensaje' => '¡Bienvenido a la página de inicio!'];
        $this->view('home', $data);
    }
   
}
?>