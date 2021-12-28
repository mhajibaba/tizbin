<?php
include_once 'connection.php';

class TableUser
{

    private static $table = "users";

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
                return "No record to delete";
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

		public static function deleteByGroup($gid)
    {
        try {

            $database = new Connection();

            $db = $database->openConnection();

            $stm = $db->prepare("DELETE FROM `".self::$table."` WHERE `group_id`= :id");
            $affectedrows = $stm->execute(array(
                ':id' => $gid
            ));

            $database->closeConnection();

            if (isset($affectedrows) && ($affectedrows > 0)) {
                return true;
            } else {
                return "No affected rows";
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function changePassword($id, $newpass, $oldpass)
    {
        try {

            $database = new Connection();
            $db = $database->openConnection();

            $stm = $db->prepare("UPDATE `".self::$table."` SET `password`=:newpass WHERE `id` = :id and `password`=:oldpass");
            $affectedrows = $stm->execute(array(
                ':newpass' => md5($newpass),
								':oldpass' => md5($oldpass),
                ':id' => $id
            ));

            $database->closeConnection();

            if (isset($affectedrows)) {
                return true;
            }
            return "Cannot change";
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function updateLoginInfo($id)
    {
        try {
            $database = new Connection();
            $db = $database->openConnection();
            $stm = $db->prepare("UPDATE `".self::$table."` SET `last_login`=now(),  logins = logins + 1 WHERE `id` = :id");
            $affectedrows = $stm->execute(array(
                ':id' => $id
            ));

            $database->closeConnection();

            if (isset($affectedrows)) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            return false;
            //echo "There is some problem in connection: " . $e->getMessage();
        }
    }

    public static function add($username, $pass, $email, $fname, $lname, $gid)
    {
        try {

            $database = new Connection();

            $db = $database->openConnection();

            if ($db == NULL) {
                return "No connection";
            }

						$role = 'NORMAL';
						if($gid==1)
								$role = 'FULL';

            // inserting data into create table using prepare statement to prevent from sql injections
            $stm = $db->prepare("INSERT INTO `".self::$table."` (username,password,email,first_name,last_name,user_type,group_id,em_key) VALUES (:username, :password, :email, :fname, :lname, :utype, :groupid,'none')");

            // inserting a record
            $affectedrows = $stm->execute(array(
                ':fname' => $fname,
								':lname' => $lname,
								':email' => $email,
                ':username' => $username,
                ':password' => md5($pass),
                ':utype' => $role,
                ':groupid' => $gid
            ));

            $database->closeConnection();


            if(isset($affectedrows))
            {
                return true;
            }
            return "cannot insert";

        } catch (PDOException $e) {

						return $e->getMessage();

        }
    }

 		public static function list_users($gid)
    {
        try {


            $database = new Connection();

            $db = $database->openConnection();

            if ($db == NULL) {
                return null;
            }

            try
						{
				        if($gid>0) {
				        		$statement = $db->prepare("SELECT `id`, `username`, `email`, `user_type`, `last_name`, `first_name`, `group_id`, `login_num`,`last_login` from `".self::$table."` where group_id =:gid ");
									 $statement->execute(array(
				            	':gid' => $gid
				        		));
								}
								else {
				        		$statement = $db->prepare("SELECT `id`, `username`, `email`, `user_type`, `last_name`, `first_name`, `group_id`, `login_num`,`last_login` from `".self::$table."`");
										 $statement->execute();
								}

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

 		public static function count()
    {
        try {

                $database = new Connection();

                $db = $database->openConnection();

                if ($db == NULL) {
                    return 0;
                }


                $stmt = $db->prepare("SELECT count(`id`) as cnt FROM `".self::$table."` ");

                // set the resulting array to associative
                $stmt->setFetchMode(PDO::FETCH_ASSOC);

                $stmt->execute();

                if ($stmt->rowCount() != 0) {

                    $result = $stmt->fetch();
                    return $result['cnt'];

                } else {
                    return 0;
                }

                $database->closeConnection();


        } catch (Exception $e) {
            if ($database != null) {
                $database->closeConnection();
            }

            return 0;
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

						$statement = $db->prepare("SELECT `id`, `username`, `password`, `first_name`, `user_type` from `".self::$table."` WHERE `username`='$user'");

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
