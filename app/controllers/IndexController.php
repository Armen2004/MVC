<?php

class IndexController extends Controller{

    public $url;
    public $model;
    public $params;

    public function __construct() {
        $this->model = $this->loadModel('Index');
        $this->params = $this->getParams();
        $this->url = Redirect::URL();
    }

    public function index(){
        $contacts = $this->model->getAllContacts();
        $data = array(
            'title' => 'Welcome',
            'contacts' => json_decode($contacts),
            'URL' => $this->url
        );
        View::make('index/index', $data);
    }
    
    public function createContact(){
        $data = array(
            'URL' => $this->url
        );
        View::make('index/contact/create-contact', $data);
    }

    public function search(){
        $data = array(
            'URL' => $this->url
        );
        View::make('index/search', $data);
    }

    public function view(){
        $contacts = $this->model->getContactById($this->params[0]);
        $email = $this->model->getEmailById($this->params[0]);
        $phone = $this->model->getPhoneById($this->params[0]);
        $address = $this->model->getAddressById($this->params[0]);
        $data = array(
            'contacts' => json_decode($contacts),
            'email' => json_decode($email),
            'phone' => json_decode($phone),
            'address' => json_decode($address),
            'uuid' => $this->params[0],
            'URL' => $this->url
        );
        View::make('index/contact/view', $data);
    }

    public function createContactInfo(){
        if(!$_POST){
            require_once __app_path__ . 'controllers/ErrorController.php';
            $controller = new ErrorController();
            $controller->Request(400);
            return false;
        }
        parse_str($_POST['data'], $data);
        if(!$data['uuid']){
            echo json_encode([
                'massage' => 'UUID Can\'t Be Empty.' ,
                'status' => false
            ]);
            return;
        }
        $query = $this->model->createContactInfo($data);
        $data = json_encode([
            'uuid' => $query['uuid'],
            'massage' => $query['massage'],
            'status' => $query['status']
        ]);
        print_r($data);
    }

    public function createEmail(){
        $id = $this->params[0];
        if(!$_POST) {
            $data = array(
                'URL' => $this->url,
                'uuid' => $id
            );
            View::make('index/email/create-email', $data);
        }else{
            parse_str($_POST['data'], $data);
            if(!$data['emails']){
                echo json_encode([
                    'massage' => 'Email(s) Can\'t Be Empty.' ,
                    'status' => false
                ]);
                return;
            }
            $emails = explode(";", $data['emails']);
            foreach($emails as $key => $val){
                if(!filter_var(trim($val), FILTER_VALIDATE_EMAIL)){
                    echo json_encode([
                        'massage' => 'You write Wrong Email(s).' ,
                        'status' => false
                    ]);
                    return;
                }
            }
            $query = $this->model->createEmails($id, $emails);
            $data = json_encode([
                'uuid' => $id,
                'massage' => $query['massage'],
                'status' => $query['status']
            ]);
            print_r($data);
        }
    }

    public function createPhone(){
        $id = $this->params[0];
        if(!$_POST) {
            $data = array(
                'URL' => $this->url,
                'uuid' => $id
            );
            View::make('index/phone/create-phone', $data);
        }else{
            parse_str($_POST['data'], $data);
            if(!$data['phones']){
                echo json_encode([
                    'massage' => 'Phone Number(s) Can\'t Be Empty.' ,
                    'status' => false
                ]);
                return;
            }
            $emails = explode(";", $data['phones']);
            $query = $this->model->createPhones($id, $emails);
            $data = json_encode([
                'uuid' => $id,
                'massage' => $query['massage'],
                'status' => $query['status']
            ]);
            print_r($data);
        }
    }

    public function createAddress(){
        $id = $this->params[0];
        if(!$_POST) {
            $data = array(
                'URL' => $this->url,
                'uuid' => $id
            );
            View::make('index/address/create-address', $data);
        }else{
            parse_str($_POST['data'], $data);
            if(!$data['name']){
                echo json_encode([
                    'massage' => 'Address Field Can\'t Be Empty.' ,
                    'status' => false
                ]);
                return;
            }
            $query = $this->model->createAddresses($id, $data);
            $data = json_encode([
                'uuid' => $id,
                'massage' => $query['massage'],
                'status' => $query['status']
            ]);
            print_r($data);
        }
    }

    public function editContactInfo(){
        $id = $this->params[0];
        if(!$_POST) {
            $contacts = $this->model->getContactById($this->params[0]);
            $data = array(
                'URL' => $this->url,
                'contacts' => json_decode($contacts),
                'uuid' => $id
            );
            View::make('index/contact/edit-contact', $data);
        }else{
            parse_str($_POST['data'], $data);
            if(!$data['uuid']){
                echo json_encode([
                    'massage' => 'UUID Can\'t Be Empty.' ,
                    'status' => false
                ]);
                return;
            }
            unset($data['uuid']);
            $query = $this->model->updateContactInfo($id, $data);
            $data = json_encode([
                'uuid' => $id,
                'massage' => $query['massage'],
                'status' => $query['status']
            ]);
            print_r($data);
        }
    }

    public function editEmail(){
        $id = $this->params[0];
        if(!$_POST) {
            $email = $this->model->getEmailById($this->params[0]);
            $emails = json_decode($email);
            $str = '';
            foreach($emails as $key => $val){
                $str .=$val->emails . "; ";
            }
            $str = rtrim($str, '; ');
            $data = array(
                'URL' => $this->url,
                'email' => $str,
                'uuid' => $id
            );
            View::make('index/email/edit-email', $data);
        }else{
            parse_str($_POST['data'], $data);
            if(!$data['uuid']){
                echo json_encode([
                    'massage' => 'UUID Can\'t Be Empty.' ,
                    'status' => false
                ]);
                return;
            }
            unset($data['uuid']);
            $query = $this->model->updateContactInfo($id, $data);
            $data = json_encode([
                'uuid' => $id,
                'massage' => $query['massage'],
                'status' => $query['status']
            ]);
            print_r($data);
        }
    }

    public function __destruct(){

    }
}

