<?php
	session_start();
	require_once "XML/RSS2.php";
	require_once "commons.php";
	

	if (isset($_POST['feedURL'])) {
		$cache_file = $_POST['feedURL'];
		$rss = new XML_RSS($cache_file);

		// Testa para ver se as variáveis estão devidamente setadas
		if (isset($rss) AND ($rss!="") AND (!empty($rss)) ){
			
			$rss->parse();	

			echo "<html><head><title>Welcome to Teckler RSS Importer </title></head>";
			echo "<body>";
			echo "<h3> Recent Blog Entries : $cache_file ... </h3>";
			echo "<hr>";
			echo "<ul>\n";

			// Testa para ver se o tamanho do array onde estão os posts > 0
			// Se >0 , sucesso
			// Se não, erro
			if (sizeof($rss->getItems())>0){

				foreach ($rss->getItems() as $entry)
				{

					//Get Title
					$title = $entry['title'];
					echo "<li><a href=\"" . $entry['link']. "\">" . $entry['title'] ."</a></li>\n";
				
					// Get Content/Body 
					// Dependendo do Blog, o conteudo vem no campo Content:Encoded ou não campo Description
					if (isset($entry['content:encoded'])) {
						echo "Content:Encoded: " . $entry['content:encoded']. "<BR>\n";
						$body = $entry['content:encoded'];
					} else{
						echo "Description:" . $entry['description']. "<BR>\n";	
						$body = $entry['description'];
					}

					// Get Publication Date
					// Recebo no Parser uma data em formato String.
					// Preciso parsear a data (que entra num array)
					$publication_full_dates = date_parse($entry['pubdate']);
					
					// Depois de parseada, eu concateno as partes que eu preciso
					$strPubDate =  	$publication_full_dates['year'] ."-" . 
									$publication_full_dates['month'] . "-" . 
									$publication_full_dates['day'] . " 00:00:00"; 

					// Depois eu crio uma data (no formato e tipo aceito) para armazenar no meu array de insert values
					$dtPubDate = date_create_from_format("Y-d-m hh:mm:ss", $strPubDate);			
					
					//DEBUG:: echo "Publication Full Date: " . $entry['pubdate'] . "<BR>\n";
					//DEBUG:: echo "Publication Short Date (as string): " . $strpubdate . "<BR>\n";
					echo "Publication Short Date (as date): " . $strPubDate . "<BR>\n";

					// For now, set Author ID = 1 (admin)
					// Aqui vai entrar depois o código para saber/setar qual o usuário que vai importar.
					echo "<hr>";
					

					/* ******************************************************************
					Prepara o array para batch insert 
					Vou inserindo todos os posts num array para depois fazer o batch insert
					********************************************************************* */
					$insertvalues[] = array(
						"article_id"	=>0,
						"author_id"		=>7,
						"ispublished"	=>1,
						"date_submitted"=>$strPubDate,
						"date_published"=>$strPubDate,
						"title"			=>$title,
						"body"			=>$body
						);
					
				
				}
				echo "</ul>\n";
				echo "<hr>";

				//Coloca os posts na sessão  --- SOLUCAO MUITO RUIM - DEPOIS MELHORO ISSO
				// Testo se a variavel está devidamente setada
				if (isset($insertvalues)){
					// Se tiver coloco na sessão
					$_SESSION['blog_posts_to_import'] = $insertvalues;
				} else {
					echo "<h3>Sorry, there was an error while processing your rss. Please go back and check your URL again.</h3>";
				}

				// Coloco os links para Aprovar ou não a inserção.
				InsertApprovalLinks();
			} else {
				echo "<h3>Sorry, there was an error while processing your rss. Please go back and check your URL again.</h3>";
			}

		} else {
			echo "<h3>Sorry, there was an error while processing your rss. Please go back and check your URL again.</h3>";
		}


	} else {
		echo "<h3>Sorry, no blog to import!</h3>\n";

	}
	



?>
<PRE>
<? // php print_r($entry); ?>
<? // php print_r($insertvalues); ?>
</PRE>
