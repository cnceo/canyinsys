<?php defined('IN_IA') or exit('Access Denied');?><div class="tab-pane" id="tab_high">
    <!--<div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否开启语音提示</label>
        <div class="col-sm-9">
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_speaker1" value="1" name="is_speaker" <?php  if($reply['is_speaker']==1) { ?>checked<?php  } ?>>
                <label for="is_speaker1"> 开启 </label>
            </div>
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_speaker2" value="0" name="is_speaker"  <?php  if($reply['is_speaker']==0 || empty($reply)) { ?>checked<?php  } ?>>
                <label for="is_speaker2"> 关闭 </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">支持预定</label>
        <div class="col-sm-9">
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_reservation1" value="1" name="is_reservation" <?php  if($reply['is_reservation']==1 || empty($reply)) { ?>checked<?php  } ?>>
                <label for="is_reservation1"> 开启 </label>
            </div>
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_reservation2" value="0" name="is_reservation" <?php  if(isset($reply['is_reservation']) && empty($reply['is_reservation'])) { ?>checked<?php  } ?>>
                <label for="is_reservation2"> 关闭 </label>
            </div>
        </div>
    </div>-->
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">支持店内</label>
        <div class="col-sm-9">
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_meal1" value="1" name="is_meal" <?php  if($reply['is_meal']==1 || empty($reply)) { ?>checked<?php  } ?>>
                <label for="is_meal1"> 开启 </label>
            </div>
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_meal2" value="0" name="is_meal" <?php  if(isset($reply['is_meal']) && empty($reply['is_meal'])) { ?>checked<?php  } ?>>
                <label for="is_meal2"> 关闭 </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">支持外卖</label>
        <div class="col-sm-9">
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_delivery1" value="1" name="is_delivery" <?php  if($reply['is_delivery']==1 || empty($reply)) { ?>checked<?php  } ?>>
                <label for="is_delivery1"> 开启 </label>
            </div>
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_delivery2" value="0" name="is_delivery" <?php  if(isset($reply['is_delivery']) && empty($reply['is_delivery'])) { ?>checked<?php  } ?>>
                <label for="is_delivery2"> 关闭 </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">支持快餐</label>
        <div class="col-sm-9">
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_snack1" value="1" name="is_snack" <?php  if($reply['is_snack']==1 || empty($reply)) { ?>checked<?php  } ?>>
                <label for="is_snack1"> 开启 </label>
            </div>
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_snack2" value="0" name="is_snack" <?php  if(isset($reply['is_snack']) && empty($reply['is_snack'])) { ?>checked<?php  } ?>>
                <label for="is_snack2"> 关闭 </label>
            </div>
        </div>
    </div>
    <!--<div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">支持排队</label>
        <div class="col-sm-9">
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_queue1" value="1" name="is_queue" <?php  if($reply['is_queue']==1 || empty($reply)) { ?>checked<?php  } ?>>
                <label for="is_queue1"> 开启 </label>
            </div>
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_queue2" value="0" name="is_queue" <?php  if(isset($reply['is_queue']) && empty($reply['is_queue'])) { ?>checked<?php  } ?>>
                <label for="is_queue2"> 关闭 </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">支持收银</label>
        <div class="col-sm-9">
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_shouyin1" value="1" name="is_shouyin" <?php  if($reply['is_shouyin']==1 || empty($reply)) { ?>checked<?php  } ?>>
                <label for="is_shouyin1"> 开启 </label>
            </div>
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_shouyin2" value="0" name="is_shouyin" <?php  if(isset($reply['is_shouyin']) && empty($reply['is_shouyin'])) { ?>checked<?php  } ?>>
                <label for="is_shouyin2"> 关闭 </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">支持智能推荐套餐</label>
        <div class="col-sm-9">
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_intelligent1" value="1" name="is_intelligent" <?php  if($reply['is_intelligent']==1 || empty($reply)) { ?>checked<?php  } ?>>
                <label for="is_intelligent1"> 开启 </label>
            </div>
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_intelligent2" value="0" name="is_intelligent" <?php  if(isset($reply['is_intelligent']) && empty($reply['is_intelligent'])) { ?>checked<?php  } ?>>
                <label for="is_intelligent2"> 关闭 </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">支持寄存</label>
        <div class="col-sm-9">
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_savewine1" value="1" name="is_savewine" <?php  if($reply['is_savewine']==1 || empty($reply)) { ?>checked<?php  } ?>>
                <label for="is_savewine1"> 开启 </label>
            </div>
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_savewine2" value="0" name="is_savewine" <?php  if(isset($reply['is_savewine']) && empty($reply['is_savewine'])) { ?>checked<?php  } ?>>
                <label for="is_savewine2"> 关闭 </label>
            </div>
        </div>
    </div>-->
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否推荐</label>
        <div class="col-sm-9">
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_hot1" value="1" name="is_hot" <?php  if($reply['is_hot']==1 || empty($reply)) { ?>checked<?php  } ?>>
                <label for="is_hot1"> 开启 </label>
            </div>
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_hot2" value="0" name="is_hot" <?php  if(isset($reply['is_hot']) && empty($reply['is_hot'])) { ?>checked<?php  } ?>>
                <label for="is_hot2"> 关闭 </label>
            </div>
            <div class="help-block">
                在搜索页显示
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">支付自动确认订单</label>
        <div class="col-sm-9">
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_auto_confirm1" value="1" name="is_auto_confirm" <?php  if($reply['is_auto_confirm']==1 || empty($reply)) { ?>checked<?php  } ?>>
                <label for="is_auto_confirm1"> 开启 </label>
            </div>
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_auto_confirm2" value="0" name="is_auto_confirm" <?php  if(isset($reply['is_auto_confirm']) && empty($reply['is_auto_confirm'])) { ?>checked<?php  } ?>>
                <label for="is_auto_confirm2"> 关闭 </label>
            </div>
            <div class="help-block">
                用户支付订单后是否自动为确认状态
            </div>
        </div>
    </div>
    <!--is_auto_confirm
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">首次下单短信验证</label>
        <div class="col-sm-9">
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_sms1" value="1" name="is_sms" <?php  if($reply['is_sms']==1) { ?>checked<?php  } ?>>
                <label for="is_sms1"> 开启 </label>
            </div>
            <div class="radio radio-info radio-inline">
                <input type="radio" id="is_sms2" value="0" name="is_sms" <?php  if(empty($reply['is_sms'])) { ?>checked<?php  } ?>>
                <label for="is_sms2"> 关闭 </label>
            </div>
            <?php  if(!empty($reply)) { ?>
            <div class="help-block" style="color:#f00;">注意:如果没有配置短信，请不要开启</div>
            <?php  } ?>
        </div>
    </div>-->
    <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">提供服务</label>
        <div class="col-sm-9">
            <div class="checkbox checkbox-success checkbox-inline">
                <input type="checkbox" name="enable_wifi" id="enable_wifi1"  value="1" <?php  if($reply['enable_wifi']==1) { ?>checked<?php  } ?>>
                <label for="enable_wifi1" style="padding-left: 0px;">wifi</label>
            </div>
            <div class="checkbox checkbox-success checkbox-inline">
                <input type="checkbox" name="enable_card" id="enable_card1"  value="1" <?php  if($reply['enable_card']==1) { ?>checked<?php  } ?>>
                <label for="enable_card1" style="padding-left: 0px;">刷卡</label>
            </div>
            <div class="checkbox checkbox-success checkbox-inline">
                <input type="checkbox" name="enable_room" id="enable_room1"  value="1" <?php  if($reply['enable_room']==1) { ?>checked<?php  } ?>>
                <label for="enable_room1" style="padding-left: 0px;">包厢</label>
            </div>
            <div class="checkbox checkbox-success checkbox-inline">
                <input type="checkbox" name="enable_park" id="enable_park1"  value="1" <?php  if($reply['enable_park']==1) { ?>checked<?php  } ?>>
                <label for="enable_park1" style="padding-left: 0px;">停车</label>
            </div>
        </div>
    </div>
</div>