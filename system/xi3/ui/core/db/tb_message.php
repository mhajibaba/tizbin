<?php

include_once 'connection.php';

class TableMessage
{

    public static function delete($id)
    {
        try 
        {

            $database = new Connection();

            $db = $database->openConnection();
            
            $stm = $db->prepare("DELETE FROM message WHERE `id`= :id") ;
            $affectedrows = $stm->execute(array(':id' => $id));

            $database->closeConnection();
            
            if (isset($affectedrows) && ($affectedrows > 0)) 
            {                
                return true;
            }else {
                return false;
            }
        } 
        catch (PDOException $e) 
        {
            return false;
            //echo "There is some problem in connection: " . $e->getMessage();
        }
    }
    
    public static function setState($id,$state) {
        
        try
        {
            $database = new Connection();
            $db = $database->openConnection();
            $stm = $db->prepare("UPDATE `message` SET `state`=:sate WHERE `id` = :id") ;
            $affectedrows = $stm->execute(array(':sate' => $state , ':id' => $id));
            
            $database->closeConnection();
            
            if(isset($affectedrows))
            {
                return true;
            }
            return false;
        }
        catch (PDOException $e)
        {
            return false;
            //echo "There is some problem in connection: " . $e->getMessage();
        }        
        
    }
    
    public static function add($name,$email,$subject,$message){
        try {
            
            $database = new Connection();
            
            $db = $database->openConnection();
            
            if($db == NULL) {
                return false;
            }
            
            // inserting data into create table using prepare statement to prevent from sql injections
            $stm = $db->prepare("INSERT INTO message (name,email,subject,message,date,state) VALUES (:name, :email, :subject, :message,now(),1)") ;
            // inserting a record
            $stm->execute(array(':name' => $name , ':email' => $email , ':subject' => $subject, ':message' => $message));
            
            $database->closeConnection();
            
            return true;
            
            
        } catch (PDOException $e) {
            
            return false;
            //echo "There is some problem in connection: " . $e->getMessage();
        }
    }
}

?>