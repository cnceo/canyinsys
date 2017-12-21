<?php defined('IN_IA') or exit('Access Denied');?>	<script type="text/javascript">
		require(['bootstrap']);
		$('.js-clip').each(function(){
			util.clip(this, $(this).attr('data-url'));
		});
	</script>
	<div class="container-fluid footer" role="footer">
		<div class="page-header"></div>
		<span class="pull-left">
			<p>Powered by <b>凯神</b> v<?php echo IMS_VERSION;?> &copy; 2017-2020 </p>
		</span>
		<span class="pull-right">
		</span>
	</div>
</body>
</html>
