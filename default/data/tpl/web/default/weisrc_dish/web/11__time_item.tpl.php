<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group">
    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
    <div class="col-sm-3">
        <div class="input-group clockpicker">
            <input type="text" class="form-control" value="09:30" name="newbegintime[]">
        <span class="input-group-addon">
        <span class="glyphicon glyphicon-time"></span>
        </span>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="input-group clockpicker">
            <input type="text" class="form-control" value="18:30" name="newendtime[]">
        <span class="input-group-addon">
        <span class="glyphicon glyphicon-time"></span>
        </span>
        </div>
    </div>
    <div class="col-sm-1">
        <a class="btn btn-default btn-sm" onclick="$(this).parents('.form-group').remove(); return false;" href="#"><i class="fa fa-times"></i></a>
    </div>
</div>