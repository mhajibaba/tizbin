<?php

include_once 'connection.php';

class TableStage
{

  private static $ptable = "pols";
  private static $stable = "sols";

  public static function list_stages()
  {
      try {


          $database = new Connection();

          $db = $database->openConnection();

          if ($db == NULL) {
              return null;
          }


          $statement = $db->prepare("SELECT `id`, `name` from `".self::$stable."`");

          try
          {
               $statement->execute();
          }
          catch(PDOException $e)
          {
               echo "Statement failed: " . $e->getMessage();
               return null;
          }

          $result = $statement->fetchAll();

          if (count($result)> 0) {

              return $result;

          } else {
              return null;
          }

          $database->closeConnection();


      } catch (Exception $e) {
          echo $e->getMessage();
          if ($database != null) {
              $database->closeConnection();
          }

          return null;
      }
  }

  public static function get_last_id()
  {
      try {


          $database = new Connection();

          $db = $database->openConnection();

          if ($db == NULL) {
              return null;
          }


          $statement = $db->prepare("SELECT last_insert_rowid() as id;");

          try
          {
               $statement->execute();
          }
          catch(PDOException $e)
          {
               echo "Statement failed: " . $e->getMessage();
               return null;
          }

          $result = $statement->fetch();

          if (count($result)> 0) {

              return $result["id"];

          } else {
              return null;
          }

          $database->closeConnection();


      } catch (Exception $e) {
          echo $e->getMessage();
          if ($database != null) {
              $database->closeConnection();
          }

          return null;
      }
  }

  public static function add($name)
  {
      try {

          $database = new Connection();

          $db = $database->openConnection();

          if ($db == NULL) {
              return "No connection";
          }

          if(strlen($name) <=0)
              return "No name is provided";

          // inserting data into create table using prepare statement to prevent from sql injections
          $stm = $db->prepare("INSERT INTO `".self::$stable."` (pol_id,name) VALUES (1,:name)");
          // inserting a record

         $affectedrows = $stm->execute(array(
              ':name' => $name
          ));

          $res = $db->lastInsertId();

          $database->closeConnection();

          if(isset($affectedrows))
          {
              return $res;
          }
          return "No affected row";

      } catch (PDOException $e) {

          return "There is some problem : " . $e->getMessage();
      }
  }

  public static function delete($id)
  {
      try {

          $database = new Connection();

          $db = $database->openConnection();

          $stm = $db->prepare("DELETE FROM `".self::$stable."` WHERE `id`= :id");
          $affectedrows = $stm->execute(array(
              ':id' => $id
          ));

          $database->closeConnection();

          if (isset($affectedrows) && ($affectedrows > 0)) {
              return true;
          } else {
              return false;
          }
      } catch (PDOException $e) {
          return false;
          // echo "There is some problem in connection: " . $e->getMessage();
      }
  }

}

?>
