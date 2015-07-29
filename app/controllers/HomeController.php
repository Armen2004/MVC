<?php

class HomeController extends Controller {

    public $url;

    public function __construct() {
        parent::__construct();
        $this->url = Redirect::URL();
    }

    public function index() {

        $contents = file_get_contents("D:/xampp/htdocs/MVC/public/files/contacts_1.json");
        $contents = utf8_encode($contents);
        $latitude = preg_replace('/"latitude":(\s*)(-?)(\s*)([0-9]{1,})(\.[0-9]{1,})?/', '"latitude":"$2$4$5"', $contents);
        $longitude = preg_replace('/"longitude":(\s*)(-?)(\s*)([0-9]{1,})(\.[0-9]{1,})?/', '"longitude":"$2$4$5"', $latitude);
        $results = json_decode($longitude, TRUE);

        $json_errors = array(
            JSON_ERROR_NONE => 'No error has occurred',
            JSON_ERROR_DEPTH => 'The maximum stack depth has been exceeded',
            JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded',
            JSON_ERROR_SYNTAX => 'Syntax error',
        );
        if($json_errors[json_last_error()] != $json_errors[JSON_ERROR_NONE]){
            echo $json_errors[json_last_error()];
            return;
        }
        //$this->createDataBase();
        echo "<pre>";
        foreach ($results as $val => $key){
            foreach ($key as $k => $v){
                if(is_array($v)){
                    print_r($k);
                    echo "<br>";
                    print_r($v);
                    echo "<br>";
                }else{
    //                print_r($k);
    //                echo "<br>";
    //                print_r($v);
    //                echo "<br>";
                }
            }
        }
    }

    public function createDataBaseAndTables() {
        $query = $this->model->createNewDatabase(DB_DATABASE);
        if ($query['status']) {
            $data = json_encode(['massage' => 'Database Created Successfully.']);
        } else {
            $data = json_encode(['massage' => $query['massage']]);
        }
    }

    public function createTable() {
        $sql = "CREATE table {DB_TABLE} ( ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,";
        for ($i = 0; $i < $count; $i++) {
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
        if ($query['status']) {
            $data = json_encode(['massage' => 'Table Created Successfully.']);
        } else {
            $data = json_encode(['massage' => $query['massage']]);
        }
        print_r($data);
    }

    public function about() {
        $data = [
            'URL' => $this->url
        ];
        View::make('home/about', $data);
    }

    public function contacts() {
        $data = [
            'URL' => $this->url
        ];
        View::make('home/contacts', $data);
    }

}
