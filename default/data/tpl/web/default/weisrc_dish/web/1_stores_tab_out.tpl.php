<?php defined('IN_IA') or exit('Access Denied');?><div class="tab-pane" id="tab_out">
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">消费满多少元免配送费</label>
        <div class="col-sm-9">
            <input type="text" name="freeprice" class="form-control" value="<?php  echo $reply['freeprice'];?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">外卖配送费用</label>
        <div class="col-sm-9">
            <input type="text" name="dispatchprice" class="form-control" value="<?php  echo $reply['dispatchprice'];?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">外卖起送价格</label>
        <div class="col-sm-9">
            <input type="text" name="sendingprice" class="form-control" value="<?php  echo $reply['sendingprice'];?>" />
            <div class="help-block">低于该金额用户无法下单，商家拒绝配送</div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">不允许选择当日配送时间</label>
        <div class="col-sm-9">
            <div class="radio radio-info radio-inline">
                <input type="radio" id="delivery_isnot_today1" value="1" name="delivery_isnot_today" <?php  if($reply['delivery_isnot_today']==1) { ?>checked<?php  } ?>>
                <label for="delivery_isnot_today1"> 开启 </label>
            </div>
            <div class="radio radio-info radio-inline">
                <input type="radio" id="delivery_isnot_today2" value="0" name="delivery_isnot_today" <?php  if(empty($reply['delivery_isnot_today'])) { ?>checked<?php  } ?>>
                <label for="delivery_isnot_today2"> 关闭 </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">允许提前几天点外卖</label>
        <div class="col-sm-9">
            <input type="text" name="delivery_within_days" class="form-control" value="<?php  echo $reply['delivery_within_days'];?>" />
            <div class="help-block">单位：天，如果只接受当天订单，请填写0</div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">配送半径</label>
        <div class="col-sm-9">
            <input type="text" name="delivery_radius" class="form-control" value="<?php  echo $reply['delivery_radius'];?>" />
            <div class="help-block">单位：公里</div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
        <div class="col-sm-9">
            <label for="not_in_delivery_radius" class="checkbox-inline">
                <input type="checkbox" name="not_in_delivery_radius" value="1" id="not_in_delivery_radius" <?php  if($reply['not_in_delivery_radius'] == 1) { ?>checked="true"<?php  } ?> /> 在配送半径之外是否允许下单
            </label>
            <div class="help-block">距离大于配送半径时是否允许下单，注意：手机定位精确性受天气、用户终端设备是否开启GPS以及硬件配置等影响很大，若此项设置为不允许下单，可能会导致部分用户无法成功下单</div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">指定配送区域</label>
        <div class="col-sm-9">
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_dispatcharea1" value="1" name="is_dispatcharea" <?php  if($reply['is_dispatcharea']==1) { ?>checked<?php  } ?>>
                <label for="is_dispatcharea1"> 开启 </label>
            </div>
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_dispatcharea2" value="0" name="is_dispatcharea" <?php  if(empty($reply['is_dispatcharea'])) { ?>checked<?php  } ?>>
                <label for="is_dispatcharea2"> 关闭 </label>
            </div>
            <div class="help-block">
            还没有配送区域，点我 <a href="<?php  echo $this->createWebUrl('dispatcharea', array('op' => 'post', 'storeid' => $storeid))?>"><i class="fa fa-plus-circle"></i> 添加配送区域</a>
            </div>
        </div>
    </div>
    <div id="time-list">
        <?php  $flag = true;?>
        <?php  if(!empty($timelist)) { ?>
        <?php  if(is_array($timelist)) { foreach($timelist as $row) { ?>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><?php  if($flag==true) { ?>配送时间<?php  } ?></label>
            <div class="col-sm-3">
                <div class="input-group clockpicker">
                    <input type="text" class="form-control" value="<?php  echo $row['begintime'];?>" name="begintimes[<?php  echo $row['id'];?>]">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="input-group clockpicker">
                    <input type="text" class="form-control" value="<?php  echo $row['endtime'];?>" name="endtimes[<?php  echo $row['id'];?>]">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                </div>
            </div>
            <div class="col-sm-2">
                <?php  if($flag==true) { ?><a href="javascript:;" id="add-time"><i class="fa fa-plus-sign-alt"></i> 添加时间</a><?php  } else { ?><a class="btn btn-default btn-sm" onclick="$(this).parents('.form-group').remove(); return false;" href="#"><i class="fa fa-times"></i></a><?php  } ?>
            </div>
        </div>
        <?php  $flag = false;?>
        <?php  } } ?>
        <?php  } else { ?>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">配送时间</label>
            <div class="col-sm-3">
                <div class="input-group clockpicker">
                    <input type="text" class="form-control" value="08:30" name="newbegintime[]">
                                <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                                </span>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="input-group clockpicker">
                    <input type="text" class="form-control" value="18:00" name="newendtime[]">
                                <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                                </span>
                </div>
            </div>
            <div class="col-sm-2">
                <a href="javascript:;" id="add-time"><i class="fa fa-plus-sign-alt"></i> 添加时间</a>
            </div>
        </div>
        <?php  } ?>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
        <div class="col-sm-9">
            <div class="help-block">请尽量以半小时为单位,方便顾客选择</div>
        </div>
    </div>
</div>