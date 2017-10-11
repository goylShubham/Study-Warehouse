	<?php
	define('DB_SERVER', '127.0.0.2');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'studywarehouse');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die("Unable to connect. Check your connection");
	?>