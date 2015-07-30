<?php

class HomeController extends Controller {

    public $url;

    public function __construct() {
        parent::__construct();
        $this->url = Redirect::URL();
//        $this->createDataBase();
        $this->createTables();
        $this->JSONLogic();
    }

    public function index() {
//        View::make('home/index', $data);
    }

    public function myFirstArrayFields(array $data, $dbTable){
//        $array = [];
        $i = 0;
        foreach($data as $kay => $value){
//            print_r($data);
            if(is_array($value)){
                echo ++$i;
//                print_r($value);
//                echo "<br>";
//                $this->myFirstArrayFields($value, $dbTable);
            }else {
                $array['dbTable'] = $dbTable;
                $array[$kay] = $value;
            }
        }
        print_r($data);
//        print_r($array);
//        return $array;
    }

    public function JSONLogic(){
        if($results = $this->readFromJSON()) {
            echo "<pre>";
//        print_r($results);
//        die;
            $data1 = [];
            $data2 = [];
            $array1 = [];
            $array2 = [];
            $array3 = [];
            foreach ($results as $kay => $val) {
                foreach ($val as $k => $v) {
                    if (is_array($v)) {
//                    print_r($k);
//                    echo "<br>";
                        $this->myFirstArrayFields($v, $k);
                    } else {
                        $data1['dbTable'] = 'contacts';
                        $array1[$k] = $v;
                    }
                }
                array_push($data2, $array2);
                array_push($data1, $array1);
//            echo $key['uuid'];
//                    echo "<br>";
            }
//        print_r($data2);
            $this->createContactsTable($array1, $data1['dbTable']);
            print_r($array1);
        }
    }

    public function readFromJSON(){
        $contents = file_get_contents($_SERVER['DOCUMENT_ROOT']. "/MVC/public/files/contacts.json");
        $contents = utf8_encode($contents);
        $latitude = preg_replace('/"latitude":(\s*)(-?)(\s*)([0-9]{1,})(\.[0-9]{1,})?/', '"latitude":"$2$4$5"', $contents);
        $longitude = preg_replace('/"longitude":(\s*)(-?)(\s*)([0-9]{1,})(\.[0-9]{1,})?/', '"longitude":"$2$4$5"', $latitude);
        $results = json_decode($longitude, true);

        $json_errors = array(
            JSON_ERROR_NONE => 'No error has occurred',
            JSON_ERROR_DEPTH => 'The maximum stack depth has been exceeded',
            JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded',
            JSON_ERROR_SYNTAX => 'Syntax error',
        );
        if($json_errors[json_last_error()] != $json_errors[JSON_ERROR_NONE]){
            require_once __app_path__ . 'controllers/ErrorController.php';
            $controller = new ErrorController();
            $controller->SyntaxError($json_errors[json_last_error()]);
            return;
        }
        return $results;
    }

    public function createDataBase() {
        $query = $this->model->createNewDatabase(DB_DATABASE);
        if ($query['status']) {
            json_encode(['massage' => 'Database Created Successfully.']);
        } else {
            json_encode(['massage' => $query['massage']]);
        }
    }

    public function createContactsTable() {
        $sql ="
CREATE TABLE IF NOT EXISTS `contacts` (
  `uuid` varchar(100) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
          CREATE table IF NOT EXISTS `contacts` (
                id int( 11 ) AUTO_INCREMENT PRIMARY KEY NOT NULL,
                `uuid` varchar(100) NOT NULL,
                `photo` varchar(200),
                `firstName` varchar(100),
                `lastName` varchar(100),
                `description` TEXT
            ) CHARACTER SET utf8 COLLATE utf8_general_ci;";
        $query = $this->model->createNewTable($sql);
        if ($query['status']) {
            json_encode(['massage' => 'Database Created Successfully.']);
        } else {
            json_encode(['massage' => $query['massage']]);
        }
    }

    public function createPhoneNumbersTable() {
        $sql =
            "CREATE table IF NOT EXISTS `phonenumbers` (
                id INT( 11 ) AUTO_INCREMENT PRIMARY KEY NOT NULL,
                `uuid` varchar(100) NOT NULL,
                `photo` varchar(200),
                `firstName` varchar(100),
                `lastName` varchar(100),
                `description` TEXT
            ) CHARACTER SET utf8 COLLATE utf8_general_ci;";
        $query = $this->model->createNewTable($sql);
        if ($query['status']) {
            json_encode(['massage' => 'Database Created Successfully.']);
        } else {
            json_encode(['massage' => $query['massage']]);
        }
    }

    public function createTables(){
        $this->createContactsTable();
    }

}
