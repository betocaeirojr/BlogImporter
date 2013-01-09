
<link rel="stylesheet" href="default.css" />  
<script src="jquery-1.3.8.js" type="text/javascript"></script>  
<HTML>
	<HEAD>
		<TITLE class="title"> Teckler Blog Import </TITLE>
	</HEAD>
	<BODY>
		<H1> Teckler.com Blog Importer</H1>
		<HR>
		<H3> Please, fill in the info bellow so we can import our curent blog to our platform. <BR>
			 It's easy, free and fun! 
		</H3>
		<FORM action="WP_RSS_Reader.php" method="post">
			<P> Blog's Feed URL: <INPUT type="text" name="feedURL" value="Fill in your blog's feed url"> </INPUT> </p>
			
			<!--
			<P> Blog's Plarfomr : 
				<SELECT name="feedPlatform">
					<OPTION value="wordpress">Wordpres</OPTION>
					<OPTION value="blogger">Blogger</OPTION>
					<OPTION value="other" cheched>Other / Unknown </OPTION>
				</SELECT>
			<P>
			-->
			<P> <INPUT type="submit" value="Import" name="Submit"> </INPUT><P>

		</FORM>
	</BODY>
</HTML>

