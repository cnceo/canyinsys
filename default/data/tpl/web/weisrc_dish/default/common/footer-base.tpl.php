<?php defined('IN_IA') or exit('Access Denied');?>	<script type="text/javascript">
		require(['bootstrap']);
		$('.js-clip').each(function(){
			util.clip(this, $(this).attr('data-url'));
		});
	</script>
	<div class="container-fluid footer" role="footer">
		<div class="page-header"></div>
		<span class="pull-left">
			<p><?php  echo $_W['setting']['copyright']['footerleft'];?>Powered by 远宇诚智慧科技   &nbsp? 2017-2020</p>
		</span>
		<span class="pull-right">
			<p><?php  echo $_W['setting']['copyright']['footerright'];?></p>
		</span>
</body>
</html>
