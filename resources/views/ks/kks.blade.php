<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>中奖者名单</title>
</head>
<body>
	<table>
		<h1>中奖者名单</h1>
		<tr>
			<td>ID</td>
			<td>名字</td>
			<td>手机号</td>
		</tr>
		@foreach ($list as $v)
		<tr>
			<td>{{$v->id}}</td>
			<td>{{$v->real_name}}</td>
			<td>{{$v->phone}}</td>
		</tr>
		@endforeach
	</table>
</body>
</html>