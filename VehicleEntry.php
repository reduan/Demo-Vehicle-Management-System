<!DOCTYPE html>
<html>
    <head>
        <title>Vehicle Information Details</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <h1><center>Vehicle Information Details</center></h1>
        <div>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
            Registration No:<input type="text" name="regNo"/><br/>
            Engine No:<input type="text" name="engineNo"/><br/>
            <input type="submit" name="submit" value="Save"/><br/>
            </form>
        </div>
        <div>
            <?php 
               if(isset($_POST['submit'])) 
               {
                   $regNo = $_POST['regNo'];
                   $engNo = $_POST['engineNo'];
                   
                   if(($regNo=='')||($engNo==''))
                   {
                       if($regNo=='')
                       {
                           echo "Please Enter Registration Number"."<br/>";
                       }
                       if($engNo=='')
                       {
                           echo "Please Enter Engine Number";
                       }
                       
                   }
                   else
                        {
                           
                $link = mysql_pconnect('localhost','root','');
		
		if(!$link)
		{
			die('Not Connected'.mysql_error());
		}
                $db_selected = mysql_select_db('VehicleInfo', $link);
                $sql1 = "SELECT * FROM VehicleEntry WHERE regNo='".$regNo."' or engNo='".$engNo."'";
                           
                $result11 = mysql_query($sql1,$link);
                $number_of_result = mysql_num_rows($result11);
            
                if($number_of_result>0){
                                
                                $sql11 = "SELECT * FROM VehicleEntry WHERE regNo='".$regNo."'";
                                $result111 = mysql_query($sql11,$link);
                                $number_of_result1 = mysql_num_rows($result111);
                                if($number_of_result1>0)
                                {
                                    echo "Registration number already exist."."<br/>";
                                }
                                $sql112 = "SELECT * FROM VehicleEntry WHERE engNo='".$engNo."'";
                                $result1112 = mysql_query($sql112,$link);
                                $number_of_result12 = mysql_num_rows($result1112);
                                if($number_of_result12>0)
                                {
                                    echo "Engine Number already exist.";
                                }
                                //echo "Data is already in database";
                               //testingdatabase('reg_no',$regno,$db);
                               //testingdatabase('serial_no',$engineno,$db);
                                
                                 
                            } 
 else {
		
		
		if(!$db_selected)
		{
			die('Error'.mysql_error());
		}
                            $sql = "INSERT INTO VehicleEntry(regNo,engNo) VALUES ('".$regNo."','".$engNo."')";
                            $result = mysql_query($sql,$link);
                            if($result)
                                {
                                    echo "Data inserted successfully";
                                }
                                else
                                {
                                    echo "data is not inserted";
                                }
                            
                           }
                        }
               }
            ?>
        </div>
        
        <div>
            <a href="index.php">Home</a> 
        </div>
    </body>
</html>
