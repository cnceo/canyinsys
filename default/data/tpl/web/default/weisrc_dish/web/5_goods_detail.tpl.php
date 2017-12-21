<?php defined('IN_IA') or exit('Access Denied');?><div class="main">
    <div class="panel panel-default">
        <div class="panel-body">
            <a class="btn btn-warning" href="<?php  echo $this->createWebUrl('goods', array('op' => 'display', 'storeid' => $storeid))?>">返回商品管理
            </a>
        </div>
    </div>
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
        <input type="hidden" name="storeid" value="<?php  echo $storeid;?>" />
        <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-pills">
                    <li role="presentation" class="active"><a href="#tab_basic" aria-controls="tab_basic" role="tab" data-toggle="pill">基本设置</a></li>
                    <!--<li role="presentation" class=""><a href="#tab_commission" aria-controls="tab_commission" role="tab" data-toggle="pill">佣金设置</a></li>-->
                    <!--<li role="presentation" class=""><a href="#tab_options" aria-controls="tab_options" role="tab" data-toggle="pill">规格设置</a></li>-->

                </ul>
            </div>
        </div>
        <div class="tab-content">
            <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/goods_tab_basic', TEMPLATE_INCLUDEPATH)) : (include template('web/goods_tab_basic', TEMPLATE_INCLUDEPATH));?>
            <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/goods_tab_commission', TEMPLATE_INCLUDEPATH)) : (include template('web/goods_tab_commission', TEMPLATE_INCLUDEPATH));?>
            <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/goods_tab_options', TEMPLATE_INCLUDEPATH)) : (include template('web/goods_tab_options', TEMPLATE_INCLUDEPATH));?>
        </div>
        <div class="form-group col-sm-12">
            <input type="submit" name="submit" value="保存设置" class="btn btn-primary col-lg-3" />
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        </div>
    </form>
</div>
<script type="text/javascript">
    <!--
    var category = <?php  echo json_encode($children)?>;
    //-->
</script>