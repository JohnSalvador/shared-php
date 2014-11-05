<!DOCTYPE html>
<html>
<head>
	<title>Source Viewer created by github:JohnSalvador</title>
	<style>
		body{
			margin: 0px;
			padding: 0px;
		}
		* {
			//border: 1px solid black;
		}
		header {
			text-align: center;
			position: absolute;
			background-color: blue;
			padding: 0px;
			width: 100%;
			margin: 0px auto;
			display: table;

		}
		section {
			padding-top: 30px;
		}
		ul{
			padding: 0px;
			margin: 0px;
		}
		li {
			list-style: none;
		list-style-image: none;	
		display: inline;
		padding-left: 20px;
		}
		a {
			color: black;
		}
	</style>
</head>
<body>
	<header>
		<ul>
		<?php
		$directory = dirname(__FILE__);
		if($handle = opendir($directory.'/')){  //make sure
		        while($file = readdir($handle)){
		                if($file!='.' && $file!='..'){
		                        echo '<li><a href="source.php?file='.$file.'">'.$file.'</a></li>';
		                }
		        }
		}
		?>
		</ul>
	</header>
	<section>
	<?php

	if(isset($_GET['file'])&!empty($_GET['file'])){
		$url=$_GET['file'];
		show_source($url);
		
	} else {
		if($handle = opendir($directory.'/')){  //make sure
		        echo 'Looking inside \''.$directory.'\':<br />';

		        while($file = readdir($handle)){
		                if($file!='.' && $file!='..'){
		                        echo '<a href="source.php?file='.$file.'">'.$file.'</a><br />';
		                }
		        }
		}
	}

	?>
	</section>
</body>
</html>
