<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" http-equiv="content-type" content="text/html">
	<title>uploadFile</title>
</head>
<body>
<form action="doAction3.php" method="post" enctype="multipart/form-data">
<!-- <input type="hidden" name="MAX_FILE_SIZE" value="31778"> -->
	请选择您要上传的文件：<input name="myFile" type="file">
	<!-- <input type="file" name="myFile" accept="image/jpeg,image/gif,image/png"><br/> -->
	<input type="submit" value="上传文件">
</form>
</body>
</html>