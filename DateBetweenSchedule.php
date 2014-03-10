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
        
     $(function() {
            $( "#datepicker1" ).datepicker({
                dateFormat: 'yy-mm-dd'
    });
        });   
</script>
    </head>
    <body>
        <h2><center>View Schedule of a Vehicle</center></h2>
        <div>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                <p>Date Between:</p> <input type="text" name="startDate" id="datepicker" />
                And <input type="text" name="endDate" id="datepicker1" /><br/>
                <input type="submit" name="submit" value="Show"/><br/>
            </form>
        </div>
   
            <?php 
              if(isset($_POST['submit']))
              {
                $startDate = $_POST['startDate'];
                $endDate = $_POST['endDate'];
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
                $q="select * from schedulevehicle WHERE date BETWEEN '$startDate' AND '$endDate'";
                    //vehicleName ='".$regNo."'";  
                $r=mysql_query($q,$link);
                ?>
                <table border="1">
                    <caption>View Schedule</caption>
                    <tr>
                     <th>Date</th>
                     <th>Vehicle</th>
                     <th>Shift</th>
                    </tr>
                <?php
                while($re=mysql_fetch_array($r))
                {
                    //$date1 = strtotime(['date']);
                    //$newDate = date('d-F-Y', $date1); 
                    $newDate = date("d-F-Y", strtotime($re['date']));
                    ?>
                    <tr>
                        <td><?php echo $newDate." "?></td>
                        <td><?php echo $re['vehicleName'] ?></td>
                        <td><?php echo $re['shift']."<br/>"; ?></td>
                    </tr>
                    <?php
                    //echo $newDate." ";
                    //echo $re['shift']."<br/>";
                    //echo $re['vehicleName']."<br/>";
                    
                }
              }
            ?>
                </table>
        <div>
            <a href="index.php">Home</a>
        </div>
     </body>
</html>