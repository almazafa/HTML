<?php
	$host="localhost";
	$husername = "root";
	$hpassword = "";
	$hdatabase= "teddy";
	$conn = new mysqli($host,$husername,$hpassword,$hdatabase);
	
	
// select c_id as id, CONCAT(made,"-",year) as description from car
// The 2 fields should be id and description
// showcombo("SelectCar",'select c_id as id, CONCAT(made,"-",year) as description from car');
function showcombo($sname,$sqlstr)	
{
	global $conn;
	$strd = "<select id=\"$sname\" name=\"$sname\" onclick=\"showselection('".$sname."')\">";
	$strd .='<option selected="" value="0">Please Select</option>';

	$result = $conn->query($sqlstr);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_array())
			$strd .= '<option value="'.$row['id'].'">'.$row['description'].'</option>';
	}
	return $strd.'</select>';
}	
?>
