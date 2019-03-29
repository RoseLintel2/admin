<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="/css/app.css">
	<style type="text/css">
table.gridtable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #666666;
	border-collapse: collapse;
	margin-top:200px; 

}
table.gridtable th {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #dedede;

}
table.gridtable td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
}
</style>
</head>
<body>
	<table border="1" width="600" align="center" class="gridtable">
		<th>ID</th>
		<th>姓名</th>
		<th>年龄</th>
		@foreach($data as $v)
			<tr align="center">
				<td>{{$v->id}}</td>
				<td>{{$v->name}}</td>
				<td>{{$v->age}}</td>
			</tr>
		@endforeach
		<tr>
			<td colspan="3">{{$data->links()}}</td>
			
		</tr>
	</table>
	
</body>
</html>