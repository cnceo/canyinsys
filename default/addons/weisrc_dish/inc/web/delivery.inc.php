<?php
global $_GPC, $_W;
$weid = $this->_weid;
$action = 'delivery';
$storeid = intval($_GPC['storeid']);

$title = $this->actions_titles[$action];
$cur_store = $this->getStoreById($storeid);
$GLOBALS['frames'] = $this->getMainMenu();

$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
if ($operation == 'display') {
    if (!empty($_GPC['keyword'])) {
        $strwhere .= " AND (username LIKE '%{$_GPC['keyword']}%' OR mobile LIKE '%{$_GPC['keyword']}%') ";
    }

    $pindex = max(1, intval($_GPC['page']));
    $psize = 10;
    $list = pdo_fetchall("SELECT * FROM " . tablename($this->table_account) . "  WHERE weid = :weid AND role=4 $strwhere ORDER BY id DESC LIMIT
" . ($pindex - 1) * $psize . ',' . $psize, array(':weid' => $this->_weid));

    foreach($list as $key => $value) {
        if (!empty($value['areaid'])) {
            $area = pdo_fetch("SELECT * FROM " . tablename($this->table_deliveryarea) . " where id = :id ORDER BY displayorder DESC", array(':id' => $value['areaid']));
            $list[$key]['areaname'] = $area['title'];
        } else {
            $list[$key]['areaname'] = '----';
        }


        $fans = $this->getFansByOpenid($value['from_user']);
        $list[$key]['headimgurl'] = $fans['headimgurl'];
        $list[$key]['delivery_price'] = $fans['delivery_price'];

    }

    if (!empty($list)) {
        $total = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename($this->table_account) . " WHERE weid = :weid AND role=4 $strwhere", array(':weid' => $this->_weid));
        $pager = pagination($total, $pindex, $psize);
    }
} else if ($operation == 'post') {
    load()->func('tpl');
    $id = intval($_GPC['id']);
    $account = pdo_fetch("SELECT * FROM " . tablename($this->table_account) . " WHERE weid = :weid AND id=:id ORDER BY id DESC", array(':weid' => $this->_weid, ':id' => $id));
    $area = pdo_fetchall("SELECT * FROM " . tablename($this->table_deliveryarea) . " where weid = :weid ORDER BY displayorder DESC", array(':weid' => $weid));
    if ($account) {
        $fans = $this->getFansByOpenid($account['from_user']);
    } else {
        $account = array(
            'role' => 4,
            'is_admin_order' => 0,
            'is_notice_order' => 0,
            'is_notice_service' => 0,
        );
    }

    if (checksubmit('submit')) {
        $data = array(
            'weid' => $this->_weid,
            'storeid' => intval($_GPC['storeid']),
            'from_user' => trim($_GPC['from_user']),
            'username' => trim($_GPC['username']),
            'mobile' => trim($_GPC['mobile']),
            'role' => 4,
            'areaid' => intval($_GPC['area']),
            'is_admin_order' => 0,
            'is_notice_order' => 0,
            'is_notice_service' => 0,
            'is_notice_boss' => 0,
            'is_notice_queue' => 0,
            'status' => intval($_GPC['status']),
            'remark' => trim($_GPC['remark']),
            'lng' => trim($_GPC['baidumap']['lng']),
            'lat' => trim($_GPC['baidumap']['lat']),
            'dateline' => TIMESTAMP,
        );

        if (empty($id)) {
            pdo_insert($this->table_account, $data);
        } else {
            pdo_update($this->table_account, $data, array('id' => $id));
        }
        message('操作成功！', $this->createWebUrl('delivery', array('op' => 'display', 'storeid' => $storeid), true));
    }
} else if ($operation == 'delete') {
    $id = intval($_GPC['id']);
    $item = pdo_fetch("SELECT id FROM " . tablename($this->table_account) . " WHERE id = :id AND weid=:weid ", array(':id' => $id, ':weid' => $_W['uniacid']));
    if (empty($item)) {
        message('抱歉，不存在或是已经被删除！', $this->createWebUrl('delivery', array('op' => 'display')), 'error');
    }
    pdo_delete($this->table_account, array('id' => $id, 'weid' => $_W['uniacid']));
    message('删除成功！', $this->createWebUrl('cordeliveryeuser', array('op' => 'display', 'storeid' => $storeid)), 'success');
} else if ($operation == 'setting') {
    $setting = $this->getSetting();
    if (checksubmit('submit')) {
        $data = array(
            'delivery_mode' => intval($_GPC['delivery_mode']),
            'delivery_commission_mode' => intval($_GPC['delivery_commission_mode']),
            'delivery_money' => floatval($_GPC['delivery_money']),
            'delivery_rate' => floatval($_GPC['delivery_rate']),
            'delivery_cash_price' => floatval($_GPC['delivery_cash_price']),
            'delivery_finish_time' => intval($_GPC['delivery_finish_time']),
            'delivery_order_max' => intval($_GPC['delivery_order_max']),//配送的最大订单量
            'delivery_auto_time' => intval($_GPC['delivery_auto_time']),//自动配送时间
        );
        if (empty($setting)) {
            pdo_insert($this->table_setting, $data);
        } else {
            pdo_update($this->table_setting, $data, array('weid' => $_W['uniacid']));
        }
        message('操作成功！', $this->createWebUrl('delivery', array('op' => 'setting', 'storeid' => $storeid), true));
    }

    if (empty($setting)) {
        $setting = array(
            'delivery_mode' => 1,
            'delivery_commission_mode' => 1,
            'delivery_money' => 0,
            'delivery_rate' => 0,
        );
    }
}
include $this->template('web/delivery');