try{
	$pdo = new PDO("mysql:host=localhost;dbname=mydb","root","111111");
	$sql = "select * from my_table where id= :id";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':id',$id);
	$id = 1;
	$stmt->execute();
	foreach($stmt->fetch(PDO::FETCH_ASSOC) as $row){
		echo $row."<br/>";
	}
}catch(Exception $e){
	$e.getMessage();
}
