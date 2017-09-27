<!DOCTYPE html>
<head>
<title> Title </title>
<link rel="stylesheet" href="style.css" />
</head>
<body> 

<div id="wrapper">

<div id="code">
	
	<h2> Enter the query below </h2>
	<form action="index.php" method="POST">
	<textarea id="query" name="query"></textarea>
	<br/><br/>
	<input type="submit" name="submit" value="QUERY" id="button" />
	</form>

</div>

<hr />

<div id="result">
	<?php
	
	$host = "localhost";
	$username = "jeeva";
	$password = "simple";
	$database = "users";
	
	$connection = mysqli_connect($host,$username,$password,$database);
	if(mysqli_connect_error()){
		echo "<span class='error'> Error connecting to the Database </span><br/>";
	}else{
		echo "<span class='success'>Connection established !</span><br/>";
		
		isset($_POST['query']) ? $query = $_POST['query'] : $query = "";
		
		echo "<span class='query'>{$query}</span><br/>";
		
		$select_reg = "/(^SELECT)|(^select)/";
		if(preg_match($select_reg,$query) || preg_match("/(^SHOW)|(^show)/",$query)){
			
			$result = mysqli_query($connection,$query);
			
			if($result){
				
				echo "Success !<br/><br/>";
				echo "<table class='tableMain'>";
				echo "<tr>";
				while ($fieldinfo = mysqli_fetch_field($result))
				{
					echo "<td class='tableHeader'>";
					echo "{$fieldinfo->name}";
					echo "</td>";
				}
				echo "</tr>";
				
				while($row = mysqli_fetch_row($result)){
					echo "<tr>";
					for( $i = 0;$i < mysqli_num_fields($result) ; $i++){
						echo "<td  class='table'>";
						echo "{$row[$i]}";
						echo "</td>";
					}
					echo "</tr>";
				}
				echo "</table>";
					
			}else{
				echo "<span class='error'> Error in querying !  </span><br/>";
				echo "<span class='error'>" .mysqli_error($connection). "</span><br/>";
			}	
				
		}else{
			
			if($query == ""){
				echo "";
				
			}else{
				$result = mysqli_query($connection,$query);
				
				if($result){
					echo "Success !";
				}else{
					echo "<span class='error'> Error in querying !  </span><br/>";
					echo "<span class='error'>" .mysqli_error($connection). "</span><br/>";
				}	
			}
				
			
			
		}
		
	}
	
	?>
</div>

</div>

</body>
</html> 
