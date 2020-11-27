<?php

namespace App;

class App
{
    public $db;

    public function __construct()
    {
        $this->db = $this->connect('localhost', 'coisas_emprestadas', 'root', '12mnmn 12');
    }

    private function connect($host, $dbname, $user, $password)
    {
        $options = array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET time_zone = "-3:00", NAMES utf8',
        );
        $db = new \PDO("mysql:host={$host};dbname={$dbname}", "{$user}", "{$password}", $options);
        $db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        return $db;
    }

    public static function response(array $data, $code = 200, $type = \JSON_FORCE_OBJECT)
    {
        header("HTTP/1.0 {$code}");
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, $type);
        exit();
    }
}
