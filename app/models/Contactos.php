<?php


namespace App\Models;

class Contactos extends DBAbstractModel
{
    private static $instancia;
    private $id;
    private $nombre;
    private $telefono;
    private $email;
    private $created_at;
    private $updated_at;


    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setTel($telefono) {
        $this->telefono = $telefono;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }

    public function setUpdatedAt($updated_at) {
        $this->updated_at = $updated_at;
    }

    public function getId() {
        return $this->id;
    }
    
    public function getNombre() {
        return $this->nombre;
    }
    public function getTel() {
        return $this->telefono;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getCreatedAt() {
        return $this->created_at;
    }
    public function getUpdatedAt() {
        return $this->updated_at;
    }

    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            $myClass = __CLASS__;
            self::$instancia = new $myClass;
        }
        return self::$instancia;
    }

    public function get($id = ""){
        if ($id != '') {
            $this -> query = "SELECT * FROM contactos WHERE id = :id";
            $this -> parametros['id'] = $id;
            $this -> get_results_from_query();
        }

        if(count($this->rows) == 1) {
            
        }
    }

    public function set(){

    }

    public function edit(){

    }

    public function delete(){

    }

}