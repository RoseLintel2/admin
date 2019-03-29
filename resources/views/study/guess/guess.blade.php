<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>我要竞猜</title>
</head>
<body>
	<div style="border:1px solid #000;width: 500px ;margin: 30px auto;height: 380px" >
		<form action="/study/guess/doguess" method="post">

			{{ csrf_field() }}
			
			<input type="hidden" value="{{$info['id']}}" name="team_id">

			<table style="margin: 0 auto;">
				<th colspan="3"><h1  style="font-size: 40px ">我要竞猜</h1></th>

				<tr>
					<td colspan="3" align="center"><h3 style="font-size: 35px ">{{$info['team_a']}}vs{{$info['team_b']}}</h3></td>
				</tr>
				<tr>
					<td style="font-size: 35px "><input type="radio" name="result" value="胜" style="width: 30px;height: 20px"> 胜</td>
					<td style="font-size: 35px "><input type="radio" name="result" value="平" style="width: 30px;height: 20px"> 平</td>
					<td style="font-size: 35px "><input type="radio" name="result" value="负" style="width: 30px;height: 20px"> 负</td>
				</tr>

				<tr>
					<td colspan="3" align="center"><input type="submit" value="竞猜" style="height: 60px;width: 190px;  border-radius:10px;background:#fff;font-size: 25px "></td>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>