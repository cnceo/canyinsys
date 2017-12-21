<?php defined('IN_IA') or exit('Access Denied');?><div class="main">
    <form action="" method="post" onsubmit="return check();" class="form-horizontal form" enctype="multipart/form-data">
        <div class="panel panel-default">
            <div class="panel-heading">
                门店配置
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">公众号名称</label>
                    <div class="col-sm-9 form-control-static">
                        <?php  echo $_W['account']['name'];?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">门店数量</label>
                    <div class="col-sm-9">
                        <input type="text" name="storecount" value="<?php  if(empty($config)) { ?>0<?php  } else { ?><?php  echo $config['storecount'];?><?php  } ?>" id="storecount" class="form-control" />
                        <div class="help-block" style="color:#f00;">为0不限制门店数量</div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">技术支持名称</label>
                    <div class="col-sm-9">
                        <input type="text" name="copyright_name" value="<?php  if(empty($config)) { ?><?php  } else { ?><?php  echo $config['copyright_name'];?><?php  } ?>" id="copyright_name" class="form-control" />
                        <div class="help-block" style="color:#f00;"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">技术支持链接</label>
                    <div class="col-sm-9">
                        <input type="text" name="copyright_url" value="<?php  if(empty($config)) { ?><?php  } else { ?><?php  echo $config['copyright_url'];?><?php  } ?>" id="copyright_url" class="form-control" />
                        <div class="help-block" style="color:#f00;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <input type="submit" name="submit" value="保存设置" class="btn btn-primary col-lg-1" />
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        </div>
    </form>
</div>