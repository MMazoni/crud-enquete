<?php

namespace SIGNOWEB\TestePratico;

use mysqli;

class Conexao
{
    public static function conectar_banco(): mysqli
    {
        $servername = "mysql";
        $username = "root";
        $password = "enquete";
        $dbname = "enquete";
        $conn = new mysqli($servername, $username, $password, $dbname);
        $conn->set_charset('utf8');

        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }

        return $conn;
    }
}



