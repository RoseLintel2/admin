<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加竞猜球队</title>
</head>
<body>
	<div style="border:1px solid #000;width: 500px ;margin: 30px auto;height: 350px" >
		<form action="/study/guess/doAdd" method="post">

			{{ csrf_field() }}

			<table style="margin: 0 auto;">
				<th colspan="3"><h1>添加竞猜球队</h1></th>
				<tr>
					<td><input type="text" style="height: 40px" name="team_a"></td>
					<td><h3>vs</h3></td>
					<td><input type="text" style="height: 40px" name="team_b"></td>
				</tr>
				<tr>
					<td><h2>结束竞猜时间</h2></td>
					<td colspan="2"><input type="text" style="height: 40px" name="end_at"></td>
				</tr>
				<tr>
					<td colspan="3" align="center"><input type="submit" value="添加" style="height: 60px;width: 190px;  border-radius:10px;background:#fff;font-size: 20px "></td>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>