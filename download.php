<?php
ini_set('display_errors',1); 
error_reporting(E_ALL);
require 'lib/db.php';

$path = $_SERVER['DOCUMENT_ROOT']."/download/"; // change the path to fit your websites document structure
$fullPath = $path."gazelli_wishingtree.xls";
//$myFile = "/download/gazelli_wishingtree.csv";
$fh = fopen($fullPath, 'w');
$limit = "20";
if($_SERVER['REQUEST_METHOD'] == "GET") {
	$page = in_array('page', $_GET) ? $_GET['page'] : 1;
} else if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$page = $_POST['page'];
	$entry_ids = $_POST['entry_id'];
	$query = "DELETE FROM customers WHERE ID IN(";
	foreach($entry_ids as $k => $v) {
		if($k > 0) {
			$query .= ", ";
		}
		$query .= $v;
	}
	$query .= ');';
	mysql_query($query);
} else {
	$page = 1;
}
$query = "SELECT * FROM customers;";
$pagedquery = "SELECT * FROM customers ORDER BY created_at DESC LIMIT ".$limit." OFFSET ".(($page * $limit) - $limit).";";
$rows = "<tr><th></th><th>Name</th><th>Email</th><th>Goal</th><th>Code</th><th>Entry date</th></tr>\n";
$num_records = 0;
if($result = mysql_query($query)) {
	$data = "";
	$data = "name\temail\tgoal\tcode\tentry-date\n";
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$data .= $query = $row['name']."\t".$row['email']."\t".stripslashes(stripslashes($row['goal']))."\t".$row['code'].$row['created_at']."\n";
	$num_records++;
	}

	//$num_records++;
	fwrite($fh, $data);
	fclose($fh);
}

if($result = mysql_query($pagedquery)) {
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$rows .= '<tr><td><input type="checkbox" name="entry_id[]" value="'.$row['id'].'"/></td><td>'.$row['name'].'</td><td>'.$row['email'].'</td><td>'.$row['goal'].'</td><td>'.$row['code'].'</td><td>'.$row['created_at'].'</td></tr>';
	}
}

/*
if ($fd = fopen ($fullPath, "r")) {
    $fsize = filesize($fullPath);

	header("Content-length: $fsize");
	header("Cache-control: private"); //use this to open files directly
    while(!feof($fd)) {
        $buffer = fread($fd, 2048);
        echo $buffer;
    }
}

fclose ($fd);
*/
mysql_close($mysqli);
?>
<html>
<head>
<link rel="icon" type="image/png" href="gazelli_icon.png">
</head>
<body>
<a href="/download/gazelli_wishingtree.xls">Download Current customer entry list</a>
<?php
echo '<style>
		table { border: 1px solid black; margin: 20px;}
		table td, table th { padding: 4px; border: 1px solid black; }
	</style>
	';
echo '<form action="download.php" method="post">';
echo '<table  cellspacing="0">';
echo $rows;
echo "</table>";
echo "<div>";
if($page > 1) {
	$prev = ($page - 1 > 0) ? "?page=".($page - 1) : "";
	echo '<a href="download.php'.$prev.'"><< previous page</a>';
}
if(($limit * $page) < $num_records) {
	$next = (($page + 1) * $limit) < ($num_records + $limit) ? "?page=".($page + 1) : "";
	echo '<a href="download.php'.$next.'">next page >></a>';
}
echo '</div>';
echo '<input type="submit" value="Delete selected records"/>';
echo '<input type="hidden" name="page" value="'.$page.'"/>';
echo '</form>';
?>
</body>
</html>