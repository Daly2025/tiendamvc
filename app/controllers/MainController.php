<?php
namespace Formacom\controllers;
use Formacom\Core\Controller;
use Formacom\Models\Customer;
use Formacom\Models\Address;
use Formacom\Models\Phone;

class MainControllerController extends Controller{
    public function index(...$params){
        $customers=Customer::all();
        //$data = ['mensaje' => '¡Bienvenido a la página de inicio!'];
        $this->view('home', $customers);
    }
    public function show(...$params)  {
        if(isset($params[0])){
            $customer=Customer::find($params[0]);
            if($customer){
                $this->view('detail',$customer);
                exit();
            }
        }

        header("Location: ".base_url()."customer");
        
    }
    public function new(){
        if(isset($_POST["name"])){
            $customer=new Customer();
            $customer->name=$_POST["name"];
            $customer->save();
            if(isset($_POST["street"]) && $_POST["street"]!=""){
                $address=new Address();
                $address->street=$_POST["street"];
                $address->zip_code=$_POST["zip_code"];
                $address->city=$_POST["city"];
                $address->country=$_POST["country"];
                $customer->addresses()->save($address);
            }
            if(isset($_POST["phonenumber"])&&$_POST["phonenumber"]!=""){
                $phone=new Phone();
                $phone->number=$_POST["phonenumber"];
                $customer->phones()->save($phone);
            }
            header("Location: ".base_url()."customer");

            
        }
        $this->view("new");
    }

    public function delete(...$params){
        if(isset($params[0])){
             $customer=Customer::find($params[0]);
             if($customer){
                $customer->delete();
             }
        }
        header("Location: ".base_url()."customer");

    }
   
}
?>