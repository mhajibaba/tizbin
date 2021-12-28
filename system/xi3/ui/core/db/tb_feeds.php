<?php
include_once 'connection.php';

class TableFeeds
{

    private static $table = "feeds";

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


            $statement = $db->prepare("SELECT `id`, ".
            " `name`, `site` from `".self::$table."` " .
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

    public static function listxml($sid,$fid)
    {
        try {


            $database = new Connection();

            $db = $database->openConnection();

            if ($db == NULL) {
                return null;
            }


            $statement = $db->prepare("SELECT `id`, `capture_date`, ".
            " `url`, `rs_bd_size`, `rs_header`, `rs_body`, `flow_info` from `feed_xmls` " .
                " WHERE `sol_id`= :sid and `feed_id` = :fid");

            try
            {
                $statement->execute(array(
                  ':sid' => $sid,
                  ':fid' => $fid
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

            $statement = $db->prepare(
              "SELECT name,COUNT(*) as cnt FROM `".self::$table."` WHERE `sol_id`= :sid group by name LIMIT 10 ");

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
