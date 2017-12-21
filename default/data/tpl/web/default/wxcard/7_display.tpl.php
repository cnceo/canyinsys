<?php defined('IN_IA') or exit('Access Denied');?><?php  load()->func('tpl')?>
<style>
	.wxcard{clear: both;margin-bottom: 20px; position: relative;}
	.wxcard .panel-body .panel-wxcard {position:relative;}
	.wxcard .panel-body .panel-wxcard .wxcard-content{width:100%; height:90px; border-radius:5px; border-bottom-left-radius:0; border-bottom-right-radius:0; border:1px solid #e7e7eb; border-bottom:0; position:relative; background-color:#A9D92C; color:#fff; font-size:16px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;}
	.wxcard .panel-body .panel-wxcard .wxcard-content img{width:60px; height:60px; position:absolute; top:15px; left:15px;}
	.wxcard .panel-body .panel-wxcard .wxcard-content .title{position:absolute; left:90px; top:30px; font-size:19px}
	.wxcard .panel-body .panel-wxcard .wxcard-footer{background-color:#fff; height:35px; line-height:35px; border:1px solid #e7e7eb; padding:0 10px; border-bottom-left-radius:5px; border-bottom-right-radius:5px;}
	.wxcard .panel-body .mask{position:absolute; width:100%; height:100%; line-height:104px; left:0; top:0; z-index:999; background-color:rgba(229, 229, 229, 0.85) !important; text-align:center; display:none;}

	.wxcard .panel-body:hover .mask{display:block}
	.wxcard .del,.panel .no{position: absolute; top:-10px; width:20px; height:20px; color:#fff; background:rgba(0,0,0,0.3); text-align:center; line-height:20px; cursor:pointer; border-radius:100%;}
	.wxcard .del{right:-10px;}
	.wxcard .no{left:-10px;background: #3071a9}
	.wxcard .del:hover{background:rgba(0,0,0,0.7);}
	.wxcard .panel:last-child{margin-bottom: 0;}
</style>
<div class="alert alert-info" style="margin-top:-20px">
	<i class="fa fa-info-circle"></i> 您可以添加多个回复卡券，系统将随机选择一个卡券推送给粉丝<br>
	<i class="fa fa-info-circle"></i> 设置为回复的卡券要保证是可用的卡券.卡券的库存应该足够大,使用期限应该有效<br>
</div>
<input type="hidden" name="replies" value="">
<div class="panel panel-default clearfix">
	<div class="panel-heading">回复内容</div>
	<div class="panel-body">
		<div class="row clearfix">
			<div class="col-xs-6 col-sm-3 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="form-group" style="margin:-15px">
							<label class="col-xs-12 control-label" style="text-align:left; padding-bottom:7px">卡券发送成功提示语</label>
							<div class="col-xs-12">
								<textarea class="form-control" name="success"><?php  echo $replies[0]['success'];?></textarea>
							</div>
						</div>
						<div class="form-group" style="margin:-15px">
							<label class="col-xs-12 control-label" style="text-align:left; padding-bottom:7px">卡券发送失败提示语</label>
							<div class="col-xs-12">
								<textarea class="form-control" name="error"><?php  echo $replies[0]['error'];?></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-default wxcard" ng-repeat="item in context.items">
					<div class="panel-body">
						<div class="panel-wxcard">
							<div class="wxcard-content" ng-style="{'background-color' : item.color}">
								<img src="" ng-src="{{item.logo_url}}" class="img-circle">
								<div class="title">{{item.title}}</div>
							</div>
							<div class="wxcard-footer clearfix">
								<div class="pull-right text-muted hide">2015-12-5</div>
								<div>{{item.brand_name}}</div>
							</div>
							<div class="mask">
								<a href="javascript:;" ng-click="context.selectCoupon(item)"><i class="fa fa-book"></i> 选择微信卡券</a>
							</div>
						</div>
					</div>
					<div class="no">{{$index + 1}}</div>
					<div class="del" ng-click="context.removeItem(item);"><i class="fa fa-times"></i></div>
				</div>
				<div class="btn btn-primary" ng-click="context.addItem()" style="margin-bottom:20px">添加一组回复</div>
			</div>
		</div>
	</div>
</div>
<script>
	window.initReplyController = function($scope, $http) {
		$scope.context = {};
		$scope.context.items = <?php  echo json_encode($replies)?>;
		if(!$.isArray($scope.context.items)) {
			$scope.context.items = [];
		}

		$scope.context.addItem = function(){
			$scope.context.items.push(
				{
					id: '',
					title: '',
					logo_url: '',
					color: '',
					brand_name: ''
				}
			);
			$scope.context.activeIndex = $scope.context.items.length - 1;
			$scope.context.activeItem = $scope.context.items[$scope.context.activeIndex];
		}

		if($scope.context.items.length == 0) {
			$scope.context.addItem();
		}
		$scope.context.activeIndex = 0;
		$scope.context.activeItem = $scope.context.items[$scope.context.activeIndex];

		$scope.context.removeItem = function(item){
			if($scope.context.items.length == 1) {
				util.message('至少有一组回复内容');
				return false;
			}
			$scope.context.items = _.without($scope.context.items, item);
			$scope.context.activeIndex = 0;
			$scope.context.activeItem = $scope.context.items[$scope.context.activeIndex];
			$scope.$digest();
		}

		$scope.context.selectCoupon = function(item) {
			var index = $.inArray(item, $scope.context.items);
			if(index == -1) return false;
			$scope.context.activeIndex = index;
			$scope.context.activeItem = $scope.context.items[$scope.context.activeIndex];

			var option = {
				'ignore' : {
					'local' : true
				},
				'multiple' : false
			};
			util.coupon(function(coupon){
				$scope.context.activeItem.card_id = coupon.card_id;
				$scope.context.activeItem.cid = coupon.id;
				$scope.context.activeItem.title = coupon.title;
				$scope.context.activeItem.logo_url = coupon.logo_url;
				$scope.context.activeItem.brand_name = coupon.brand_name;
				$scope.$digest();
			}, option);
		};
	};

	window.validateReplyForm = function(form, $, _, util, $scope) {
		if($scope.context.items.length == 0) {
			util.message('没有回复内容', '', 'error');
			return false;
		}
		var error = {empty: false, message: ''};
		angular.forEach($scope.context.items, function(v, k){
			if($.trim(v.cid) == '' || $.trim(v.card_id) == '') {
				this.empty = true;
			}
		}, error);
		if(error.empty) {
			util.message('存在没有设置 "卡券" 的回复条目');
			return false;
		}
		var val = angular.toJson($scope.context.items);
		$(':hidden[name=replies]').val(val);
		return true;
	};
</script>
