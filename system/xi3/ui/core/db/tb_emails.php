<?php
include_once 'connection.php';

class TableEmail
{
    private static $table = "emails";

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

            if ($db == null) {
                return null;
            }


            $statement = $db->prepare("SELECT `id`, `capture_date`, `sender` ".
            " `recievers`, `subject`, `data_size`, `mime_path`, `attach_dir`, `flow_info` from `".self::$table."` " .
                " WHERE `sol_id`= :sid");

            try {
                $statement->execute(array(
                  ':sid' => $sid
                ));
            } catch (PDOException $e) {
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

            if ($db == null) {
                return null;
            }

            $statement = $db->prepare(
                "SELECT * FROM (SELECT date(capture_date) as dt ,COUNT(*) as cnt FROM `".self::$table."` " .
              " WHERE `sol_id`= :sid group by dt order BY dt desc LIMIT 10 ) order BY dt "
            );

            try {
                $statement->execute(array(
                  ':sid' => $sid
                ));
            } catch (PDOException $e) {
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
