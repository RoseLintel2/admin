<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>模拟抢红包</title>
</head>

<body >
	<br><br>
		
		 
	<br><br>
	<div class="panel-body panel-body-nopadding" id="kep">
	 <input type="radio" name="sex" value="2" checked="checked" > <input type="radio" name="sex" value="3" checked="" ><button v-on:click="sex" >点</button>
		<form  class="form-horizontal form-bordered" onsubmit="return false;">
				
			{{ csrf_field() }}


				
			<div class="form-group">
              <label class="col-sm-3 control-label">红包金额</label>
              <div class="col-sm-6">
                <input type="text" placeholder="红包金额" class="form-control" name="total_amount" />
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">红包数量</label>
              <div class="col-sm-6">
                <input type="text" placeholder="红包数量" class="form-control" name="total_num"/>
              </div>
            </div>
			
			 
			 <div class="row">
				<div class="col-sm-6 col-sm-offset-3">
				  <button class="btn btn-primary btn-danger" v-on:click="addBonus">发红包</button>&nbsp;
				</div>

			 </div>

			 <br><br><br><br>

			<div class="panel-footer"></div>

		</form>
	

		<div class="col-md-12"  >

	        <div class="table-responsive" v-if="seen">
	            <table class="table table-danger mb30">
	                <thead>
	                <tr>
	                    <th>ID</th>
	                    <th>总金额</th>
	                    <th>剩余金额</th>
	                    <th>总个数</th>
	                    <th>剩余个数</th>
	                    <th>操作</th>
	                </tr>
	                </thead>
	                <tbody>
	                <tr v-for="bonus in Bonus_list">
	                    <td>{bonus.id}</td>
	                    <td>{bonus.total_amount}</td>
	                    <td>{bonus.left_amount}</td>
	                    <td>{bonus.total_num}</td>
	                    <td>{bonus.left_num}</td>
	                    <td>
	                        <button class="btn btn-warning" v-if="bonus.left_num <=0 ">红包已经抢完了</button>
	                        <button class="btn btn-danger" v-on:click="getBonus(bonus.id)" v-else>抢红包</button>
	                        <button class="btn btn-primary" v-if="bonus.left_num <=0 " v-on:click="getMaxBonus(bonus.id)">查看红包记录</button>
	                    </td>
	                </tr>
	                </tbody>
	            </table>
	   	 	</div><!-- table-responsive -->

			<div class="table-responsive" v-else>
	            <table class="table table-danger mb30">
	                <thead>
		                <tr>
		                    <th>用户ID</th>
		                    <th>用户名</th>
		                    <th>头像</th>
		                    <th>用户抢到的金额</th>
		                    <th>运气王</th>
		                    
		                </tr>
		                </thead>
		                <tbody>
		                <tr v-for="bonu in MaxBonus_list">
		                    <td>{bonu.id}</td>
		                    <td>{bonu.username}</td>
		                    <td><img v-bind:src="bonu.image" alt="" height="40" width="60"></td>
		                    <td>{bonu.money}</td>
		                    <td><button class="btn btn-danger" v-if="bonu.flag == 1">运气王</button></td>
		                   <!--  <td>
		                        <button class="btn btn-danger" v-on:click="bonusLists">抢红包</button>
		                    </td> -->
		                </tr>
	                </tbody>
	            </table>
	        </div><!-- table-responsive -->

		</div>
				<!-- 红包记录信息 -->
	<!-- 	<div class="col-md-12" >
	        
	    </div> -->

	</div>
</body>
<link rel="stylesheet" href="/css/app.css">
<script src="/js/app.js"></script>
<script src="/js/md5.js"></script>
<script src="/js/vue.js"></script>

<script src="/js/jquery-1.12.0.min.js"></script>

<script>
	var kep =new Vue({
		el:"#kep",
		delimiters: ['{', '}'],
		data:{
			Bonus_list:[],
			seen:true,
			MaxBonus_list:[]
			
		},
		created:function(){
			this.bonusLists();

		},
		methods:{
			//红包列表
			bonusLists:function(){
				var that = this;
				$.ajax({
					url:"list",
					type:"get",
					data:{},
					dataType:"json",
					success:function(res){
						if(res.code == 2000){
							
							that.Bonus_list = res.data;
							
						}else{
							 console.log(res.msg);
						}
					},
					error:function(e){

					}
				})
			},
			//人气王
			getMaxBonus:function($bonus_id){
				var that = this;
				
				var bonus_id = $bonus_id;

				$.ajax({
					url:"flag",
					type:"get",
					data:{	
						bouns_id:bonus_id
					},
					dataType:"json",
					success:function(res){
						if(res.code == 2000){
							that.seen=false;
							that.MaxBonus_list = res.data;
						}else{
							 console.log(res.msg);
						}
						

					},
					error:function(e){

					}
				})
			},
			//发红包
			addBonus:function(){
				var that = this;
				var token = $("input[name=_token]").val();
				var total_amount = $("input[name=total_amount]").val();
				var total_num = $("input[name=total_num]").val();
				if(total_amount == "" || total_num == ""){
					alert('参数不能为空');
					return false;
				}
				$.ajax({
					url:"add",
					typt:"post",
					data:{
						token:token,
						total_amount:total_amount,
						total_num:total_num
					},
					dataType:"json",
					success:function(res){
						if(res.code == 2000){
							alert('成功发送红包');
							that.bonusLists();
						}
					},
					error:function(e){

					}
				})
			},
			sex:function(){
				var kp =$('input[name="sex"]:checked').val();
				alert(kp);
			},
			//抢红包
			getBonus:function($bonus_id){
				var that1 = this;
				
				var user_id = 3;
				var bonus_id = $bonus_id;
				$.ajax({
					url:"/study/get/bonus",
					type:"get",
					data:{	
						user_id:user_id,
						bonus_id:bonus_id
					},
					dataType:"json",
					success:function(res){
						if(res.code == 2000){
							alert('成功领取红包');
							that1.bonusLists();
						}else{
							alert(res.msg);
							
						}
					},
					error:function(e){

					}
				})
			}
		}
	});
</script>
</html>