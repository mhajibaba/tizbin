<?php
include_once 'connection.php';

class TableTFTP
{

    private static $table = "tftps";
    private static $table_files = "tftp_files";

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


            $statement = $db->prepare("SELECT `id`, `capture_date`, `url`, ".
            " `cmd_path`, `flow_info`, `download_num`, `upload_num` from `".self::$table."` " .
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

    public static function listfiles($sid,$fid)
    {
        try {


            $database = new Connection();

            $db = $database->openConnection();

            if ($db == NULL) {
                return null;
            }


            $statement = $db->prepare("SELECT `id`, `capture_date`, `filename`, ".
            " `file_percentual`, `flow_info`, `file_size`, `file_path`, `dowloaded` from `".self::$table_files."` " .
                " WHERE `sol_id`= :sid and `ftp_id` = :fid");

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
              "SELECT strftime('%Y-%m',capture_date) as dt, download_num, COUNT(*) as cnt FROM `".self::$table."` ".
                " WHERE `sol_id`= :sid group BY dt, download_num ORDER BY dt desc LIMIT 6");

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

    public static function get_stat_files($sid)
    {
        try {


            $database = new Connection();

            $db = $database->openConnection();

            if ($db == NULL) {
                return null;
            }

            $statement = $db->prepare(
              "SELECT strftime('%Y-%m',capture_date) as dt,dowloaded, COUNT(*) as cnt ".
              " FROM `".self::$table_files."` WHERE `sol_id`= :sid GROUP by dt, dowloaded ORDER BY dt desc LIMIT 10");

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
