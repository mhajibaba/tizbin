<?php
include_once 'connection.php';

class TableWEB
{

    private static $table = "webs";

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

            $statement = $db->prepare("SELECT `id`, `capture_date`, `host`, `url`, `agent`, `method`, ".
            " `content_type`, `response`, `flow_info`, `rq_header`, `rq_body`, `rs_header`, `rs_body` from `".self::$table."` " .
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

    public static function get_stat_webget($sid)
    {
        try {


            $database = new Connection();

            $db = $database->openConnection();

            if ($db == NULL) {
                return null;
            }

            $statement = $db->prepare("SELECT strftime('%Y-%m',capture_date) as dt,  count(method) as cnt ".
            " FROM `".self::$table."` WHERE `sol_id`= :sid AND method = 'GET' GROUP BY dt ORDER BY dt desc LIMIT 10");

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

    public static function get_stat_webpost($sid)
    {
        try {


            $database = new Connection();

            $db = $database->openConnection();

            if ($db == NULL) {
                return null;
            }

            $statement = $db->prepare("SELECT strftime('%Y-%m',capture_date) as dt,  count(method) as cnt ".
            " FROM `".self::$table."` WHERE `sol_id`= :sid AND method = 'POST' GROUP BY dt ORDER BY dt desc LIMIT 10");

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
