<?php

	function InsertApprovalLinks(){

		echo "<h4> What you want to do now?</h4>";
		//echo "<form action=\"BlogAppender.php\" method=\"post\">";
		//echo "<input type=\"submit\" name=\"submit\" value=\"Import my Blog!\">";
		//echo "<input type=\"submit\" name=\"cancel\" value=\"Forget About It!\">";
		//echo "<input type=\"hidden\" name=\"cancel\" value=\"$SQLInsertValues\">";
		echo "<a href=\"BlogAppender.php?action=Import&author=1\"> Import this Posts</a> or <a href=\"../index.php\"> just cancel and forget it all</a>";
	}


?>