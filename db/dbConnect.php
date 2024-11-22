<?php
class MySql extends mysqli {

    private static $instance;

    public $con;
    public $servername;
    public $username;
    public $password;
    public $database;

    private function __construct($filePath = 'db/config.php') {
        $configs = include($filePath);
        if(!$configs["user"]){
            $configs = include($f2);
        }
        $this->username = $configs['user'];
        $this->password = $configs['pass'];
        $this->database = $configs['name'];
        $this->servername = $configs['host'];
        parent::__construct($this->servername, $this->username, $this->password, $this->database);
        if ($this->connect_errno) {
            die("Connection failed: " . $this->connect_error);
        }
        $this->set_charset("utf8mb4");
    }
    private function __clone() {}
	private function __wakeup() {}

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    function escape($sql) {
        return $this->real_escape_string($sql);
    }

    function select($sql) {
        //$sql = $this->escape($sql);
        $res = $this->query($sql);
        if ($res === false) {
            die("error select " . $sql);
        }
        $rows = [];
        while ($row = $res->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    function insert($sql) {
        //$sql = $this->escape($sql);
        if ($this->query($sql) === true) {
            return true;
        } else {
            die("error insert " . $sql . " " . $this->error);
        }
    }

    function update($sql) {
        return $this->insert($sql);
    }

    function delete($sql) {
        return $this->insert($sql);
    }

    function __destruct() {
        $this->close();
    }

    function pretty_var_dump($var, $indent = 0) {
        if (is_array($var)) {
            echo "Array(" . count($var) . ") {<br>";
            foreach ($var as $key => $value) {
                echo str_repeat("&nbsp;&nbsp;&nbsp;", $indent + 1) . "'" . $key . "' => ";
                $this->pretty_var_dump($value, $indent + 1);
            }
            echo str_repeat("&nbsp;&nbsp;&nbsp;", $indent) . "}<br>";
        } else {
            echo var_export($var, true) . ",<br>";
        }
    }
}
?>