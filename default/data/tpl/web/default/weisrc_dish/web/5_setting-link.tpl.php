<?php defined('IN_IA') or exit('Access Denied');?><div class="tab-pane" id="tab_link">
    <div class="panel panel-default">
        <div class="panel-heading">
            手机端用户中心<code>(不填默认为自带会员卡链接)</code>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">会员卡名称</label>
                <div class="col-sm-9">
                    <input type="text" name="link_card_name" class="form-control" value="<?php  echo $setting['link_card_name'];?>" />
                    <div class="help-block"></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">会员卡链接</label>
                <div class="col-sm-9">
                    <input type="text" name="link_card" class="form-control" value="<?php  echo $setting['link_card'];?>" />
                    <div class="help-block"></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">签到名称</label>
                <div class="col-sm-9">
                    <input type="text" name="link_sign_name" class="form-control" value="<?php  echo $setting['link_sign_name'];?>" />
                    <div class="help-block"></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">签到链接</label>
                <div class="col-sm-9">
                    <input type="text" name="link_sign" class="form-control" value="<?php  echo $setting['link_sign'];?>" />
                    <div class="help-block"></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">充值名称</label>
                <div class="col-sm-9">
                    <input type="text" name="link_recharge_name" class="form-control" value="<?php  echo $setting['link_recharge_name'];?>" />
                    <div class="help-block"></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">充值链接</label>
                <div class="col-sm-9">
                    <input type="text" name="link_recharge" class="form-control" value="<?php  echo $setting['link_recharge'];?>" />
                    <div class="help-block"></div>
                </div>
            </div>
        </div>
    </div>
</div>