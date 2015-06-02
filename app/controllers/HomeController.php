<?php

class HomeController extends Controller{

    public $url;
    
    public function __construct() {
        parent::__construct();
        $this->url = Redirect::URL();
    }
    public function index(){
        $dbNames = $this->model->showDBS();
        $dbs = [];
        $arr = ['information_schema', 'performance_schema', 'mysql', 'phpmyadmin'];
        foreach($dbNames as $key=>$val){
            if(in_array($val["Database"], $arr)){
                continue;
            }
            $dbTableNames = $this->model->showTablesByDB($val["Database"]);
            $dbs[$val["Database"]] = $dbTableNames;
        }
        $data = array(
            'name' => $dbs,
            'URL' => $this->url
        );
        View::make('home/index', $data);
    }

    public function createDataBase(){
        if(!$_POST){
            require_once __app_path__ . 'controllers/ErrorController.php';
            $controller = new ErrorController();
            $controller->Request(400);
            return false;
        }
        parse_str($_POST['data'], $data);
        $database = $data['database'];
        $query = $this->model->createNewDatabase($database);
        if($query['status']){
            $data = json_encode(['massage' => 'Database Created Successfully.']);
        }else{
            $data = json_encode(['massage' => $query['massage']]);
        }
        print_r($data);
    }

    public function createTable(){
//        var_dump($_POST);die;
        if(!$_POST){
            require_once __app_path__ . 'controllers/ErrorController.php';
            $controller = new ErrorController();
            $controller->Request(400);
            return false;
        }
        parse_str($_POST['data'], $data);
        $count = $_POST['count'];
        $database = $data['database'];
        $table_name = $data['table_name'];
        $sql = "CREATE table $table_name ( ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,";
        for($i = 0; $i < $count; $i++){
            $field_names = "field_name_$i";
            $field_name = $data[$field_names];
            $field_types = 'field_type_' . $i;
            $field_type = $data[$field_types];
            $field_lengths = 'field_length_' . $i;
            $field_length = $data[$field_lengths];
//            if($field_length < 0){
//                return false;
//            }
//            Prename VARCHAR( 50 ) NOT NULL,

            $sql .= $field_name . " " . $field_type . "( " . $field_length . " ) NOT NULL,";
        }
        $sql = rtrim($sql, ",");
        $sql .= ");";
        $query = $this->model->createNewTable($database, $sql);
        if($query['status']){
            $data = json_encode(['massage' => 'Table Created Successfully.']);
        }else{
            $data = json_encode(['massage' => $query['massage']]);
        }
        print_r($data);
    }
    
    public function about(){
        $data = [
            'URL' => $this->url
        ];
        View::make('home/about', $data);
    }
    
    public function contacts(){
        $data = [
            'URL' => $this->url
        ];
        View::make('home/contacts', $data);
    }

}