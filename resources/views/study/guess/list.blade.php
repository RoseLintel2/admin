<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>赌球列表</title>
</head>
<body>
	<div style="border:1px solid #000;width: 500px ;margin: 30px auto;" >
		
			<table style="margin: 0 auto;">

				<th colspan="3"><h1  style="font-size: 40px ">竞猜列表</h1></th>

				@foreach ($list as $v)
					<tr>
						<td><h3 style="font-size: 35px ">{{$v['team_a']}} vs {{$v['team_b']}}</h3></td>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td>
							<h3>
								 @if ( strtotime($v['end_at']) > time())
								 	<a href="/study/guess/guess?id={{$v['id']}}"><input type="button" value="竞猜" style="height: 40px;width: 160px;  border-radius:10px;background:#fff;font-size: 20px "></a>
								 @else
									<a href="/study/guess/Result?id={{$v['id']}}"><input type="button" value="查看结果" style="height: 40px;width: 160px;  border-radius:10px;background:#fff;font-size: 20px "></a>
								 @endif
							</h3>
						</td>
					</tr>
				@endforeach
			</table>
		
	</div>
</body>
</html>