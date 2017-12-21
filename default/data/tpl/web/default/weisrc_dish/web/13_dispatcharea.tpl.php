<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<?php  if($operation == 'post') { ?>
<div class="main">
    <div class="panel panel-default">
        <div class="panel-body">
            <a class="btn btn-warning"
               href="<?php  echo $this->createWebUrl('dispatcharea', array('op' => 'display', 'storeid' => $storeid))?>">返回配送区域管理
            </a>
        </div>
    </div>
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
        <input type="hidden" name="parentid" value="<?php  echo $parent['id'];?>" />
        <div class="panel panel-default">
            <div class="panel-heading">
                配送区域详细设置
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
                    <div class="col-sm-9 input-group">
                        <input type="text" name="displayorder" class="form-control" value="<?php  echo $dispatcharea['displayorder'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">区域名称</label>
                    <div class="col-sm-9 input-group">
                        <input type="text" name="title" class="form-control" value="<?php  echo $dispatcharea['title'];?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <input type="submit" name="submit" value="保存设置" class="btn btn-primary col-lg-3" />
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        </div>
    </form>
</div>
<?php  } else if($operation == 'display') { ?>
<ul class="nav nav-tabs">
    <li <?php  if($operation == 'display' || empty($operation)) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('dispatcharea', array('op' => 'display', 'storeid' => $storeid))?>">配送区域管理</a></li>
    <li <?php  if($operation == 'post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('dispatcharea', array('op' => 'post', 'storeid' => $storeid))?>">添加配送区域</a></li>
</ul>
<div class="main">
    <div class="panel panel-default">
        <div class="table-responsive panel-body">
            <form action="" method="post" class="form-horizontal form" >
                <input type="hidden" name="storeid" value="<?php  echo $storeid;?>" />
                <table class="table table-hover table-bordered">
                    <thead class="navbar-inner">
                        <tr>
                            <th style="width:5%;" class='with-checkbox'><input type="checkbox" class="check_all" /></th>
                            <th style="width:10%;">顺序</th>
                            <th style="width:35%;">配送区域名称</th>
                            <th style="width:10%;text-align:right;">操作</th>
                        </tr>
                    </thead>
                    <tbody id="level-list">
                        <?php  if(is_array($dispatcharea)) { foreach($dispatcharea as $row) { ?>
                        <tr>
                            <td class="with-checkbox"><input type="checkbox" name="check" value="<?php  echo $row['id'];?>"></td>
                            <td><input type="text" class="form-control" name="displayorder[<?php  echo $row['id'];?>]" value="<?php  echo $row['displayorder'];?>"></td>
                            <td><input type="text" class="form-control" style="width:150px;" name="goodsname[<?php  echo $row['id'];?>]" value="<?php  echo $row['title'];?>"></td>
                            <td style="text-align:right;"><a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('dispatcharea', array('op' => 'post', 'id' => $row['id'], 'storeid' => $storeid))?>" title="编辑">改</a>&nbsp;&nbsp;<a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('dispatcharea', array('op' => 'delete', 'id' => $row['id'], 'storeid' => $storeid))?>" onclick="return confirm('确认删除此配送区域吗？');return false;" title="删除">删</a></td>
                        </tr>
                        <?php  } } ?>
                        <tr>
                            <td colspan="4">
                                <input name="submit" type="submit" class="btn btn-primary" value="保存设置">
                                <input type="button" class="btn btn-primary" name="btndeleteall" value="批量删除" />
                                <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
            <?php  echo $pager;?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $(".check_all").click(function () {
            var checked = $(this).get(0).checked;
            $("input[type=checkbox]").attr("checked", checked);
        });

        $("input[name=btndeleteall]").click(function () {
            var check = $("input[type=checkbox][class!=check_all]:checked");
            if (check.length < 1) {
                alert('请选择要删除的配送区域!');
                return false;
            }
            if (confirm("确认要删除选择的配送区域?")) {
                var id = new Array();
                check.each(function (i) {
                    id[i] = $(this).val();
                });
                var url = "<?php  echo $this->createWebUrl('dispatcharea', array('op' => 'deleteall', 'storeid' => $storeid))?>";
                $.post(
                        url,
                        {idArr: id},
                        function (data) {
                            alert(data.error);
                            location.reload();
                        }, 'json'
                        );
            }
        });

    });
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>