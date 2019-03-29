<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>竞猜结果</title>
</head>
<body>
	<div style="border:1px solid #000;width: 500px ;margin: 30px auto;" >
		
			<table style="margin: 0 auto;">

				<th colspan="3"><h1  style="font-size: 40px ">竞猜结果</h1></th>

				
					<tr>
						<td><h3 style="font-size: 35px ">对阵结果:</h3></td>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td>
							<h3 style="font-size: 35px ">
								{{$info['team_a']}}
								<b style="color: red">{{$info['result']}}</b>
								{{$info['team_b']}} 	
							</h3>
								
						</td>
					</tr>
					@if ( !empty($info2) )
						<tr>
							<td><h3 style="font-size: 35px ">您的竞猜:</h3></td>
							<td>&nbsp;&nbsp;&nbsp;</td>
							<td>
								<h3 style="font-size: 35px ">
									{{$info['team_a']}}
									<b style="color: red">{{$info2->result}}</b>
									{{$info['team_b']}}	
								</h3>
							</td>
						</tr>

						@if ( $info2->result != $info['result'] )
							<tr>
								<td><h3 style="font-size: 35px ">结果:</h3></td>
								<td><h3 style="font-size: 35px ">恭喜你,</h3></td>
								<td><h3 style="font-size: 35px "><b style="color: red">猜错了</b></h3></td>
							</tr>
						@else
							<tr>
								<td><h3 style="font-size: 35px ">结果:</h3></td>
								<td><h3 style="font-size: 35px ">很抱歉,</h3></td>
								<td><h3 style="font-size: 35px "><b style="color: red">你猜对了</b></h3></td>
							</tr>
						@endif

					@else
						<tr>
							<td><h3 style="font-size: 35px ">结果:</h3></td>
							<td><h3 style="font-size: 35px ">&nbsp;&nbsp;&nbsp;</h3></td>
							<td><h3 style="font-size: 35px "><b style="color: red">你没参与竞猜</b></h3></td>
						</tr>
					@endif
			</table>
		
	</div>
</body>
</html>