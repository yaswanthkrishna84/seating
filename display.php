<?php

$db=mysqli_connect("localhost","root","","exams");

if(isset($_POST['get']))
{
	$reg_no=$_POST['reg_no'];
	$std_row="select * from allocate where reg_no='$reg_no' ";
	$std=mysqli_query($db,$std_row);
	if($res=mysqli_fetch_assoc($std))
	{
	 $rno=$res['rno'];
	 $room = "select * from allocate where rno= '$rno' group by row";
	 $room_res=mysqli_query($db,$room);
	?>
	<html>
	<head>
	<title>"Seating"</title>
	<body>
	<center>
	<table border="3" cellspacing="0">
	<caption align="top">Room number: <?php echo $rno ?></caption>
	 <?php 
	 while($dis = mysqli_fetch_assoc($room_res))
	 {
		 $row_no=$dis['row'];
		 $std_row = "select * from allocate where rno='$rno' and row='$row_no' group by col";
		 $same_row_stdts=mysqli_query($db,$std_row);
		 ?>
		 <tr>
		 <?php
		 while($stdts=mysqli_fetch_assoc($same_row_stdts))
		 {
			 $col=$stdts['col'];
			 $bench="select * from allocate where rno='$rno' and row='$row_no' and col='$col' ";
			 $benchmates=mysqli_query($db,$bench);
			 $bench_count=mysqli_num_rows($benchmates);
			 while($bench_result=mysqli_fetch_assoc($benchmates))
			 {
				 $regno=$bench_result['reg_no'];
				 $std_yr="select year from stud where reg_no=$regno";
	          ?>
		   <td width=100px <?php if($bench_result['reg_no']==$_POST['reg_no']){?> bgcolor = "orange"<?php }?> > <?php echo $bench_result['reg_no']?></td>
	    <?php
			 }
			 if($bench_count == 1)
             {?>
		     <td width=100px></td>
			 <?php }}?>
		</tr>
		<?php
	 }
	}
}

	else
		echo '<script>alert("Please check register number")</script>';
		//echo '<script>alert("Please check register number")</script>';
?>
</center>
</table>
</body>
</html>