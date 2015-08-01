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
        print_r($this->params);
        $contacts = $this->model->getAllContacts();
        $data = array(
            'title' => 'Welcome',
            'contacts' => $contacts,
            'URL' => $this->url
        );
        View::make('index/index', $data);
    }
    
    public function createContact(){
        $data = array(
            'URL' => $this->url
        );
        View::make('index/create-contact', $data);
    }

    public function search(){
        $data = array(
            'URL' => $this->url
        );
        View::make('index/search', $data);
    }

    public function view($id){
        print_r($id);
    }

    public function createContactInfo(){
        if(!$_POST){
            require_once __app_path__ . 'controllers/ErrorController.php';
            $controller = new ErrorController();
            $controller->Request(400);
            return false;
        }
        parse_str($_POST['data'], $data);

        $query = $this->model->createContactInfo($data);
        $data = json_encode([
            'massage' => $query['massage'],
            'status' => $query['status']
        ]);
        print_r($data);
    }

    public function __destruct(){

    }
}

