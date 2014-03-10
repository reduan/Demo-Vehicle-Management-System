<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <h2><center>View Schedule of a Vehicle</center></h2>
        <div>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
              <?php 
                
                $link = mysql_pconnect('localhost','root','');		
		if(!$link)
		{
			die('Not Connected'.mysql_error());
		}
		
		$db_selected = mysql_select_db('VehicleInfo', $link);
		if(!$db_selected)
		{
			die('Error'.mysql_error());
		}
                    $query = "SELECT * FROM vehicleentry ORDER By regNo ASC";
                    $result = mysql_query($query,$link);
                   echo '<select name = "regNo">';
                    while ($rows = mysql_fetch_array($result))
                    {
                        echo '<option>'.$rows['regNo'].'</option>';
                    }
                   echo '</select>'
                ?>
                <input type="submit" name="submit" value="Show"/><br/>
            </form>
        </div>
        <div>
            <?php 
              if(isset($_POST['submit']))
              {
                $regNo = $_POST['regNo'];
                $link = mysql_pconnect('localhost','root','');
		
		if(!$link)
		{
			die('Not Connected'.mysql_error());
		}
		
		$db_selected = mysql_select_db('VehicleInfo', $link);
		if(!$db_selected)
		{
			die('Error'.mysql_error());
		}
                /*
                     SELECT State, Count(CustomerID) As NumberOfCustomers
                     FROM Customers
                     WHERE State <> "NY"
                     GROUP BY State
                     HAVING Count(CustomerID) >10
                     ORDER BY Count(CustomerID) DESC
                */
                $q="select * from schedulevehicle WHERE vehicleName ='".$regNo."'";  
                $r=mysql_query($q,$link);
                ?>
                <table border="1">
                    <caption>View Schedule</caption>
                    <tr>
                     <th>Date</th>
                     <th>Already Booked Shift</th>
                    </tr>
                <?php
                while($re=mysql_fetch_array($r))
                {
                    //$date1 = strtotime(['date']);
                    //$newDate = date('d-F-Y', $date1); 
                    $newDate = date("d-F-Y", strtotime($re['date']));
                    $dateShow = date('l', strtotime($re['date']));
                    //echo ",";
                    //echo $newDate;
                    //echo "<br/>";
                    ?>
                    <tr>
                        <td><?php echo $dateShow,",",$newDate?></td>
                        <td><?php echo $re['shift']."<br/>"; ?></td>
                    </tr>
                    <?php
                    //echo $re['shift']."<br/>";
                    //echo $re['date']."&nbsp;".$re['shift']."<br>";
                }
              }
            ?>
                </table>
        </div>
        
        <div>
            <a href="index.php">Home</a> 
        </div>
    </body>
</html>
