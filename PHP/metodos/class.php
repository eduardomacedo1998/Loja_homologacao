<?php  


class Database {
    private $host;
    private $username;
    private $password;
    private $dbname;
    private $conn;


    public function __construct($host, $username, $password, $dbname) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;


        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);


        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }


    public function select($table) {  // função para select
        $query = "SELECT * FROM $table";
        $result = $this->conn->query($query);
        $rows = array();


        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }


        return ( $rows);
    }

    public function selectLogin($table, $usuario, $senha) {
        $query = "SELECT id, usuario FROM $table WHERE usuario = '$usuario' AND senha = '$senha'";
        $result = $this->conn->query($query);
        $rows = array();
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
    
        return json_encode($rows); // Convertendo o array em JSON
    }
    


    public function insert($table, $data) {   // função para inserir dados
        $keys = implode(", ", array_keys($data));
        $values = "'" . implode("', '", $data) . "'";
        $query = "INSERT INTO $table ($keys) VALUES ($values)";
       
        if ($this->conn->query($query) === TRUE) {
            return true;
        } else {
            return false;
        }
    }


    public function delete($table, $id) { // função de update
        $query = "DELETE FROM $table WHERE id = $id";
       
        if ($this->conn->query($query) === TRUE) {
            return true;
        } else {
            return false;
        }
    }




    public function updateVerificationStatus($table, $userId, $newVerificationStatus) {
        $query = "UPDATE $table SET verificacao = '$newVerificationStatus' WHERE id = $userId";
       
        if ($this->conn->query($query) === TRUE) {
            return true;
        } else {
            return false;
        }
    }


    public function __destruct() {
        $this->conn->close();
    }
}







