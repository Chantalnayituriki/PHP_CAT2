<?php
include "../../includes/config/connection.php";
if (isset($_POST['import']))
	{
        $filename =$_FILES["file"]['tmp_name'];
        if($_FILES["file"]['size']>0)
        {
            $file = fopen($filename, "r");

            while (($data = fgetcsv($file, 1000, ",")) !== FALSE)
            {
                $sql = 'INSERT INTO student(fname,lname,email,vacc_code,regno,phone,gender,created_at,user_id) VALUES(:fname,:lname,:email,:vacc_code,:regno,:phone,:gender,:created_at,:user_id)'; 

                $stmt = $conn->prepare($sql);
               $stmt->execute([':fname' =>$data[0],':lname' =>$data[1],':email' =>$data[2],':vacc_code' =>$data[3],':regno' =>$data[4],':phone' =>$data[5],':gender' =>$data[6],':created_at' =>$data[7],':user_id' =>$data[8]]);
                if($statement)
                {
                    echo 'inserted';
                }
            }
            fclose($file);
            header("Location: /group_one/dashboard/home.php");
        }
        else
        {
            echo "File Size not Suported";
        }
	
 
	}
 
?>