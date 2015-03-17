<?php

class HomeController extends Controller{

    public function index(){
        $dbNames = $this->model->showDBS();
//echo "<pre>";
        $dbs = [];
        $arr = ['information_schema', 'performance_schema', 'mysql'];
        foreach($dbNames as $key=>$val){
            if(in_array($val["Database"], $arr)){
                continue;
            }
            $dbTableNames = $this->model->showTablesByDB($val["Database"]);
            $dbs[$val["Database"]] = $dbTableNames;
        }
//        print_r($dbs);
//        die;
        $data = array(
            'name' => $dbs
        );
        View::make('home/index', $data);
    }

    public function create(){
//        $this->model->run();
    }

    public function createTable(){
        print_r($_POST);
        print_r(unserialize($_POST['data']));
//        $data = explode('&',$_POST['data']);
//        $result = [];
//        foreach($data as $key => $val){
//            $a = explode('=', $val);
//            if($a[0] == 'table_name'){
//                $table_name = $a[1];
//            }elseif($a[0] == 'database'){
//                $database = $a[1];
//            }else{
//            }
//            print_r($val);
//        }
//        print_r($data);
//        $this->model->createNewTable();
//        echo json_decode(serialize($_POST));
    }

}