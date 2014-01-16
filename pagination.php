<?php
//database connection using php pdo

$database = '';  //db name
$user = '';      //db user
$password = '';  //db password

$dsn = "mysql:host=localhost;dbname=$database";
$pdo = new PDO($dsn, $user, $password);

//get number of entries in table
$cnt = $pdo->query("SELECT COUNT(*) FROM tbl_name");  
$total_pages = $cnt->fetchColumn();

//current page pagination is taking place
$targetpage = "mypage.php"; 

$limit = 5; //number of entries to show at a time

//get the current pagination page
//if its on first results set page to 1
$page = isset($_GET['page']) ? $_GET['page']: 1;

//set the start point of the queries on the table
$start = $page ? ($page - 1)*$limit : 0;

//database query based on $start parameters given
$pds = $pdo->query("SELECT * FROM tbl_name LIMIT $start, $limit");


	if($page == 0) $page = 1;

	//setting of values for previous and next buttons
	$prev = $page - 1;
	$next = $page + 1;

	$lastpage = ceil($total_pages/$limit);

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