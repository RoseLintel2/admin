<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>

<body>

	<div id="kk">
		红包金额 ： <input type="text" name="total_amount">
		<br>
		<br>
		红包个数 ： <input type="text" name="total_num">
		<br>
		<br>
		<button v-on:click="addBonus">发红包</button>

		<br><br><br>
		<table border="1" width="600">
				<th>id</th>
				<th>红包总额</th>
				<th>红包剩余总额</th>
				<th>红包总个数</th>
				<th>红包剩余个数</th>
			<tr v-for="list in BonusLists">
				<th>{{list['id']}}</th>
				<th>{{list['total_amount']}}</th>
				<th>{{list['left_amount']}}</th>
				<th>{{list['total_num']}}</th>
				<th>{{list['left_num']}}</th>
			</tr>
		</table>
	</div>

</body>
	<script src="/js/app.js"></script>

	<script src="/js/vue.js"></script>
	<script src="/js/jquery-1.12.0.min.js"></script>
	<script>
		var kep =new Vue({
			el: "#kk",
			data:{

			},
			created:function(){
				BonusLists:[]
			},
			methods:{

				addBonus:function(){
					var total_amount =$("input[name=total_amount]").val();
					var total_num =$("input[name=total_num]").val();

					$.ajax({
						url:"addBonus",
						type:"get",
						data:{
							total_amount:total_amount,
							total_num:total_num
						},
						dataType:"json",
						success:function(res){
							if(res.code == 2000){
								alert('发红包成功');
							}
						},
						error:function(data){

						}
					})
				},

				BonusList:function(){
					var that = this;
					$.ajax({
						url:"list",
						type:"get",
						data:{
							
						},
						dataType:"json",
						success:function(res){
							if(res.code == 2000){
								that.BonusLists = res.data;
							}
						},
						error:function(data){

						}
					})
				}
			}
			
		})
	</script>
</html>