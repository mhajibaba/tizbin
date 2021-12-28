<?php
include_once 'connection.php';

class TableUnknows
{

    private static $table = "unknows";

    public static function delete($id)
    {
        try {


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


    public static function list($sid)
    {
        try {


            $database = new Connection();

            $db = $database->openConnection();

            if ($db == NULL) {
                return null;
            }

            $statement = $db->prepare("SELECT `id`, `capture_date`, `dst`, ".
            " `dst_port`, `flow_info`, `l7prot`, `size` from `".self::$table."` " .
                " WHERE `sol_id`= :sid");

						try
						{
                $statement->execute(array(
                  ':sid' => $sid
                ));
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

    public static function get_stat($sid)
    {
        try {


            $database = new Connection();

            $db = $database->openConnection();

            if ($db == NULL) {
                return null;
            }

            $statement = $db->prepare("SELECT l7prot ,count(*) as cnt FROM `".self::$table."` ".
                         " WHERE `sol_id`= :sid group by l7prot ORDER BY cnt desc");

            try
            {
                $statement->execute(array(
                  ':sid' => $sid
                ));
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
}

?>
