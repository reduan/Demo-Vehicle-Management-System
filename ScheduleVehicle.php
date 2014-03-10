<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
         <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <link rel="stylesheet" href="/resources/demos/style.css" />
        <script>
        $(function() {
            $( "#datepicker" ).datepicker({
                dateFormat: 'yy-mm-dd'
    });
        });
</script>
    </head>
    <body>
        <h1><center>Vehicle Information Details</center></h1>
        <div>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                Select Vehicle:
                <?php 
                        $lin = mysql_pconnect('localhost','root','');
                        $db_selected = mysql_select_db('VehicleInfo', $lin);
                        if(!$db_selected)
                        {
                        	die('Error'.mysql_error());
                        }
                        $query = "SELECT * FROM vehicleentry ORDER By regNo ASC";
                        $result = mysql_query($query,$lin);
                        echo '<select name = "regNo">';
                        while ($rows = mysql_fetch_array($result))
                        {
                            echo '<option>'.$rows['regNo'].'</option>';
                        }
                        echo "</select>";
                ?>
                <p>Select Date: <input type="text" name="date" id="datepicker" /></p>
                <p>Select Shift: 
                    <?php 
                        $lin1 = mysql_pconnect('localhost','root','');
                        $db_selected1 = mysql_select_db('VehicleInfo', $lin);
                        if(!$db_selected1)
                        {
                        	die('Error'.mysql_error());
                        }
                         $qu = "SELECT * FROM shiftEntry ORDER By shift ASC";
                        $resul = mysql_query($qu,$lin1);
                        echo '<select name = "shift">';
                        while ($rows = mysql_fetch_array($resul))
                        {
                            echo '<option>'.$rows['shift'].'</option>';
                        }
                        echo "</select>";
                ?>
                   <!-- <select name="shift" autofocus>
                        <option value="Morning">Morning</option>
                        <option value="Evening">Evening</option>
                    </select>
                   -->
                </p>
                <p>Booked By:<input type="text" name="bookedBy"/> </p>
                <p>Address:<input type="text" name="address"/></p>
                 <input type="submit" name="submit" value="Save"/><br/>
            </form>
        </div>
        <div>
            <?php 
                 if(isset($_POST['submit']))
                     {
                        $regNo = $_POST['regNo'];
                        $date = $_POST['date'];
                        $shift = $_POST['shift'];
                        $bookedBy = $_POST['bookedBy'];
                        $address = $_POST['address'];
                        
                        $lin = mysql_pconnect('localhost','root','');
                        $db_selected = mysql_select_db('VehicleInfo', $lin);
                        if(!$db_selected)
                        {
                        	die('Error'.mysql_error());
                        }
                        $qll="select * from schedulevehicle where vehicleName='".$regNo."' and date='".$date."' and shift='".$shift."'";
                                                
                        $result11 = mysql_query($qll,$lin);
                        $number_of_result = mysql_num_rows($result11);
            
                        if($number_of_result>0)
                            {    
                              while ($rows = mysql_fetch_array($result11))
                              {
                                echo "This schedule is already Booked by ",$rows['bookedby'];
                              }  
                              //echo "This schedule already Booked by ",$bookedBy;        
                            }  
                        else 
                        {
                        
                        $ql = "INSERT INTO schedulevehicle(vehicleName,date,shift,bookedby,address)
                            VALUES ('".$regNo."','".$date."','".$shift."','".$bookedBy."','".$address."')";
                        $result1 = mysql_query($ql,$lin);
                        mysql_close();
                        if($result1)
                         {
                              echo "This data is successfully inserted";
                         }
                        else
                         {
                               echo "data is not inserted";
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
