<?php
//database connection

$database = ''; //db name
$user = ''; //db user
$password = ''; //db password

$dsn = "mysql:host=localhost;dbname=$database";
$pdo = new PDO($dsn, $user, $password);

$cnt = $pdo->query("SELECT COUNT(*) FROM tbl_name");  
$total_pages = $cnt->fetchColumn();

$targetpage = "mypage.php"; 
$limit = 5;
$page = isset($_GET['page']) ? $_GET['page']: 1;

$start = $page ? ($page - 1)*$limit : 0;

$pds = $pdo->query("SELECT * FROM tbl_name LIMIT $start, $limit");


//pagination
	if($page == 0) $page = 1;
	$prev = $page - 1;
	$next = $page + 1;
	$lastpage = ceil($total_pages/$limit);
	$lpm1 = $lastpage - 1;
	$pagination = "";
	if($lastpage > 1){
	    $pagination .="<div class='pagination'>";
	    //prev button
	    if($page > 1){
		$pagination .= "<a href='$targetpage?page=$prev' title='Previous'>&lt;&lt;</a>&nbsp;&nbsp;"; 
	    }else{
		$pagination .= "<span class='disabled' title='Previous'>&lt;&lt;</span>&nbsp;&nbsp;";
	    }
	    
	    
	    //next button
	    if($page < $lastpage){
		$pagination .= "<a href='$targetpage?page=$next' title='Next'>&gt;&gt;</a>";
	    }else{
		$pagination .= "<span class='disabled' title='Next'>&gt;&gt;</span>";
	    }
	   $pagination .= "</div>";
	}
	    echo $pagination;

?>