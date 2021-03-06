<?php defined('IN_IA') or exit('Access Denied');?><div class="panel panel-default">
	<div class="panel-heading">
		回复内容
	</div>
	<ul class="list-group">
		<li class="list-group-item">
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">视频标题</label>
				<div class="col-sm-9 col-xs-12">
					<input type="text" class="form-control" placeholder="添加视频消息的标题" name="title" value="<?php  echo $replies['title'];?>" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">视频链接</label>
				<div class="col-sm-9 col-xs-12">
					<?php  echo tpl_form_field_wechat_video('mediaid', $replies['mediaid']);?>
					<span class="help-block">请上传触发关键字时所要回复的视频，上传视频必须是MP4类型</span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">视频描述</label>
				<div class="col-sm-9 col-xs-12">
					<textarea style="height:80px;" class="form-control" cols="70" name="description" placeholder="添加视频的简短描述"><?php  echo $replies['description'];?></textarea>
					<span class="help-block">描述内容将出现在视频名称下方，建议控制在20个汉字以内最佳</span>
				</div>
			</div>
		</li>
	</ul>
</div>


