<!DOCTYPE html>
<html lang="ko">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />
	<title></title>
	<link href="css/style.css" rel="stylesheet" />
</head>
<body>
	<form method="GET">
		<textarea name="texto"></textarea>
		<button type="submit" value="">Traducir</button>

		<div style='width:100%; height:500px; border:1px solid black;'>
			{{$texto}}
		</div>
	</form>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
</body>
</html>
