<?php
include_once 'connection.php';

class TableGroup
{

    private static $table = "groups";

    public static function delete($id)
    {
        try {

						if($id==1)
							return "cannot delete admin";

            $database = new Connection();

            $db = $database->openConnection();

            $stm = $db->prepare("DELETE FROM `".self::$table."` WHERE `id`= :id");
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

   
    public static function add($name)
    {
        try {

            $database = new Connection();

            $db = $database->openConnection();

            if ($db == NULL) {
                return false;
            }

						if(strlen($name) <=0)
								return false;

            // inserting data into create table using prepare statement to prevent from sql injections
            $stm = $db->prepare("INSERT INTO `".self::$table."` (name) VALUES (:name)");
            // inserting a record

				   $affectedrows = $stm->execute(array(
                ':name' => $name              
            ));

            $database->closeConnection();
            
            if(isset($affectedrows))
            {
                return true;
            }
            return false;

        } catch (PDOException $e) {

						echo "There is some problem : " . $e->getMessage();
            return false;            
        }
    }

 		public static function list_groups()
    {
        try {
            
            
            $database = new Connection();
            
            $db = $database->openConnection();
            
            if ($db == NULL) {
                return null;
            }

            
            $statement = $db->prepare("SELECT `id`, `name` from `".self::$table."`");

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

 	

    public static function checkUser($user,$pass)
    {
        try {
            

            $database = new Connection();

            $db = $database->openConnection();

            if ($db == NULL) {
                return null;                
            }

						$statement = $db->prepare("SELECT `id`, `username`, `password`, `first_name`, `group_id` from `".self::$table."` WHERE `username`='$user'");

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
 
                $hash = $result[0]['password'];

                // $hash would be the $hash (above) stored in your database for this user
                if (md5($pass)==$hash) {
                    $id = $result[0]['id'];
                    return $result[0];
                } else {
                    return null;                    
                }
                
            }else {
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
}

?>
