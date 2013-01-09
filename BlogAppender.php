<?php
session_start();

//echo "DEBUG::";
//echo "<PRE>";
//print_r($_SESSION);
//echo "</PRE>";
//echo "DEBUG::";

// SQLInsertValues é um Array de Arrays 
$SQLInsertValues = $_SESSION['blog_posts_to_import'];

$PostLenght = count($SQLInsertValues);

$sqlstat =  "insert ignore into cms_articles (" . 
			"article_id, author_id, is_published, date_submitted, date_published, " . 
			"title, body" . 
			") values " ;

$counter = 0;
foreach ($SQLInsertValues as $value) {
	$counter += 1; 
	//echo "DEBUG::" . $counter; 
	//echo "DEBUG::Article_ID: " 		.  $value['article_id'] . "<BR>\n";
	//echo "DEBUG::Title: " 			.  $value['title'] . "<BR>\n";
	//echo "DEBUG::Date Published: " 	.  $value['date_published'];

	// Assembling the SQL Statement
	$sqlstat .= 	"(" . 
					$value['article_id'] 								. ", " . 
					$value['author_id'] 								. ", " . 
					$value['ispublished'] 								. ", " .
					"'" . $value['date_submitted']						. "', " .
					"'" . $value['date_published']						. "', " .
					"'" . htmlentities($value['title'], ENT_QUOTES) 	. "', " . 
					"'" . htmlentities($value['body'], ENT_QUOTES) 		. "'" . 
					")" ; 
	
	if ($counter <= ($PostLenght-1)) {
		// Enquanto não chegar no final do array, continuo colocando (valor1, valor2, ..., valorn)
		$sqlstat .= ",";
	}

}

//echo "DEBUG:: <BR>\n";
//echo "<BR>". $sqlstat . "<BR>\n";
//echo "DEBUG:: <BR>\n";

include "conn.php";

if (isset($_GET['action']) and ($_GET['action']=="Import")) {
	// Mando a consulta para o banco de dados
	// echo "DEBUG:: <BR>Inserindo no Banco de dados.... <BR>";
	
	$queryok = mysqli_query($conn, $sqlstat) ;
	if (!$queryok){
	    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
	} else {
		echo "<h2>Dados inseridos com sucesso! <h2>";
		echo "<a href=\"http://localhost/PHP/CMS_v2-ml/index.php\">Back to Index</a>";

	}

} else {
	header("location:index.php");
}


?>