<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
/*
$database_name = "xpages";

$mysql_server = 'localhost:3306';

$username = "root";

$password = "iopex@123";
*/
//ini_set('max_execution_time', 1000);

function execute_query($server_name, $user_name, $db_password, $dbname){
	$mysql_link = mysql_connect($server_name, $user_name, $db_password) or die("Could not establish connection");

	$db = mysql_select_db($dbname, $mysql_link);

	$table_index = "Tables_in_".$dbname;

	$table_list = array();

	$table_with_text = "<table border='1'><tr><th>Table Name</th><th> Column Name</th></tr><tr>";

	$table_with_columns = "<table border='1'> <tr><th> Table Name </th> <th> COLUMNNAME</th><th> values </th> </tr><tr>";
	
	$query = "SELECT Data_TYPE, table_name, COLUMN_NAME FROM information_schema.columns ";
	$query .= "where DATA_TYPE='TEXT' and table_schema='".$dbname."'";

	
	$tablelist = mysql_query($query);


	while($typ = mysql_fetch_array($tablelist)){
		
		$table_with_text .= "<tr><td>". $typ["table_name"]. "</td><td>";

		$table_with_text .= $typ["COLUMN_NAME"] ."</td></tr>";

		$getByColumnLength = "select count(*) as total from ".$typ["table_name"]." where length(".$typ["COLUMN_NAME"].") >65530";

		$countByColumn = mysql_query($getByColumnLength) or exit(mysql_error());

		$row_count = mysql_fetch_assoc($countByColumn);
	
		$table_with_columns .= "<tr><td>".$typ["table_name"]."</td><td>".$typ["COLUMN_NAME"]."</td><td>";
		$table_with_columns .= $row_count['total']."</td></tr>";
		
	}

	$table_with_text .="</table>";

	$table_with_columns .= "</table>";

	$result_table = array('table' => $table_with_text,'columns' => $table_with_columns);

	return $result_table;
}
?>


<?php
if($_SERVER['REQUEST_METHOD'] === 'GET'){

?>
<html>
<head>
	<title> Traversing the database </title>
</head>
<body>
	<form action ="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
		<table>
			<tbody>
				<tr><td><label>Server Name </label></td>
					<td><input type="text" value="" name="server_name"/></td>
				</tr>
				<tr>
					<td><label> Username </label></td>

					<td><input type="text" value="" name="username"/></td>
				</tr>
				<tr>

					<td><label> password</label></td>
					<td><input type="password" value="" name="password"/></td>
				</tr>
				<tr>

					<td><label>database name </label></td>
				

					<td><input type="text" value="" name="db_name"/></td>
				</tr>
				<tr><td></td>

					<td><input type="submit" value="submit"/></td>
				</tr>
			</tbody>
		</table>
</form>
</body>

</html>

<?php
} else{	
	$table_list = execute_query($_POST["server_name"], $_POST["username"], $_POST["password"], $_POST["db_name"]);

	echo "<h3>Table list that has TEXT fields in it</h3><br/>";
	echo $table_list["table"];
	echo "<h3> Column list that exceeds 2^16 characters</h3><br/>";
	echo $table_list["columns"];
}
?>