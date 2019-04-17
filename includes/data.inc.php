<?php
class DB
{
    private static $instance = NULL;
    private $pdo;



    private function __construct()
    {

        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=slogin', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
        } catch (PDOException $e) {
            echo "Connection Failed" . $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
                        self::$instance = new DB();
        }
        return self::$instance;      
    }
  public function getDB(){
      if($this->pdo instanceof PDO){
          return $this->pdo;
      }
  }



}
