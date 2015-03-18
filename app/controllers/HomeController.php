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
        parse_str($_POST['data'], $data);
        $count = $_POST['count'];
//        print_r($data);
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
//        print_r($sql);
        $this->model->createNewTable($database, $sql);
//        echo json_decode(serialize($_POST));
    }

}