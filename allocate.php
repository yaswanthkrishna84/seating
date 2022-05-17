<?php
$db=mysqli_connect("localhost","root","","exams");
if(isset($_POST['set']))
{

$del_query="delete from allocate";
mysqli_query($db,$del_query);

$yr=$_POST['year'];
echo $yr;
if($yr == "2")
{
   $std="select * from stud where year=2";
   $rooms="select * from room where year=2";
}
if($yr == "3")
{
   $std="select * from stud where year=3";
   $rooms="select * from room where year=3";
}
if($yr == "2&3")
{
	$std="select * from stud where year in (2,3)";
    $rooms="select * from room where year in (2,3)";
}
$std_res=mysqli_query($db,$std);
$room_res=mysqli_query($db,$rooms);
$count=mysqli_num_rows($std_res);
$st=0;
while($count > 0)
{
	$room=mysqli_fetch_assoc($room_res);
	
	//echo $room['rno']." ".$count."<br>"; //checking rooms fetch;
	
	$cols=$room['cols'];
	$end=$room['row'];
	$sec_std_col_res=array();
	$trd_std_col_res=array();
	while($cols--)
	{
		if($yr=="2" || $yr=="2&3")
		{
		$query="select * from stud where year=2 limit $st,$end ";
		$col_std=mysqli_query($db,$query);
		array_push($sec_std_col_res,$col_std);
		}
		if($yr=="3" || $yr=="2&3")
		{
			$query="select * from stud where year=3 limit $st,$end ";
		    $col_std=mysqli_query($db,$query);
		    array_push($trd_std_col_res,$col_std);
		}
	//	echo $room['rno']."  ".$st."  ".$end;
	//	echo "<br>";
		$st=$st+$end;
		$end=$room['row'];
		
	}
	  
	   $std_col=1;
	   
	  

	if($yr=="2" || $yr=="2&3")   
	{
	foreach($sec_std_col_res as $stds_rows)
	{
		$std_row=1;
		while($std_result = mysqli_fetch_assoc($stds_rows))
		{
			
			$reg_num=$std_result['regno'];
			$room_no=$room['rno'];
			$insert_query = "insert into allocate values ('$reg_num','$room_no','$std_row','$std_col')";
			
			mysqli_query($db,$insert_query);
			$std_row++;
		}
		$std_col++;
	}
	}
	$std_col=1;
	if($yr=="3" || $yr=="2&3")
	{
	foreach($trd_std_col_res as $stds_rows)
	{
		$std_row=1;
		while($std_result = mysqli_fetch_assoc($stds_rows))
		{
			
			$reg_num=$std_result['regno'];
			$room_no=$room['rno'];
			$insert_query = "insert into allocate values ('$reg_num','$room_no','$std_row','$std_col')";
			
			mysqli_query($db,$insert_query);
			$std_row++;
		}
		$std_col++;
	}
	}
	
	$count=$count - ($room['row']*$room['cols']);
	
}
echo "Successfully allocated";
}
?>