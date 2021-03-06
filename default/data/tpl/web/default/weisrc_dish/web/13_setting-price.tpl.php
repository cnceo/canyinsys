<?php defined('IN_IA') or exit('Access Denied');?><div class="tab-pane" id="tab_price">
    <div class="panel panel-default">
        <div class="panel-heading">
            提现设置
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">最低提现金额</label>
                <div class="col-sm-6 col-md-8 col-xs-12">
                    <div class="input-group ">
                        <input type="text" name="getcash_price" class="form-control" value="<?php  echo $setting['getcash_price'];?>">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button">元</button>
							</span>
                    </div>
                    <span class="help-block">最低提现金额不能小于1元，建议填写整数，不填写为不限制</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">提现费率</label>
                <div class="col-sm-6 col-md-8 col-xs-12">
                    <div class="input-group ">
                        <input type="text" name="fee_rate" class="form-control" value="<?php  echo $setting['fee_rate'];?>">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button">%</button>
							</span>
                    </div>
						<span class="help-block">商户申请提现时，每笔申请提现扣除的费用，默认为空，即提现不扣费，支持填写小数<br>
						<span style="color: red">门店默认提现费率</span>
						</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">提现费用</label>
                <div class="col-sm-6 col-md-8 col-xs-12">
                    <div class="input-group">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button">最低</button>
							</span>
                        <input type="text" name="fee_min" class="form-control"  value="<?php  echo $setting['fee_min'];?>">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button">元</button>
							</span>
                    </div>
                    <div class="input-group" style="margin-top: .5rem">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button">最高</button>
							</span>
                        <input type="text" name="fee_max" class="form-control" value="<?php  echo $setting['fee_max'];?>">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button">元</button>
							</span>
                    </div>
						<span class="help-block">商户提现时，提现费用的上下限，最高为空时，表示不限制扣除的提现费用<br>
							例如：提现100元，费率5%，最低1元，最高2元，商户最终提现金额=100-2=98<br>
							例如：提现100元，费率5%，最低1元，最高10元，商户最终提现金额=100-100*5%=95<br>
						<span style="color: red">门店默认提现费用</span>
						</span>
                </div>
            </div>
        </div>
    </div>
</div>