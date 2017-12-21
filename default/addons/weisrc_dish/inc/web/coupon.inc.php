<?php
global $_W, $_GPC;
load()->func('tpl');
$weid = $_W['uniacid'];
$action = 'coupon';
$title = $this->actions_titles[$action];

$storeid = intval($_GPC['storeid']);
$this->checkStore($storeid);
$returnid = $this->checkPermission($storeid);
$cur_store = $this->getStoreById($storeid);
$GLOBALS['frames'] = $this->getNaveMenu($storeid,$action);

$url = $this->createWebUrl($action, array('storeid' => $storeid));
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
if ($operation == 'display') {
    $coupon_type = array(
        '1' => '商品赠送',
        '2' => '代金券',
        '3' => '礼品券',
        '4' => '积分兑换'
    );
    $coupon_attr_type = array(
        '1' => '消费券',
        '2' => '营销券'
    );

    if (checksubmit('submit')) { //排序
        if (is_array($_GPC['displayorder'])) {
            foreach ($_GPC['displayorder'] as $id => $val) {
                $data = array('displayorder' => intval($_GPC['displayorder'][$id]));
                pdo_update($this->table_coupon, $data, array('id' => $id));
            }
        }
        message('操作成功!', $url);
    }

    $pindex = max(1, intval($_GPC['page']));
    $psize = 15;
    $where = "WHERE weid = {$weid} AND storeid={$storeid} AND type<>4";

    $attrtype = intval($_GPC['attrtype']);
    if ($attrtype != 0) {
        $where .= " AND attr_type = " . $attrtype;
    }

    $coupons = pdo_fetchall("SELECT * FROM " . tablename($this->table_coupon) . " {$where} order by displayorder desc,id desc LIMIT " . ($pindex - 1) * $psize . ",{$psize}");
    if (!empty($coupons)) {
        $total = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename($this->table_coupon) . " $where");
        $pager = pagination($total, $pindex, $psize);
    }

    $sncount = pdo_fetchall("SELECT count(1) as count,couponid FROM " . tablename($this->table_sncode) . " WHERE weid={$weid} GROUP BY couponid", array(), 'pid');
    //普通券
    $type_count1 = pdo_fetchcolumn("SELECT COUNT(1) FROM " . tablename($this->table_coupon) . " WHERE attr_type = 1 AND weid=:weid AND storeid={$storeid} AND type<>4", array(':weid' => $weid));
    //营销券
    $type_count2 = pdo_fetchcolumn("SELECT COUNT(1) FROM " . tablename($this->table_coupon) . " WHERE attr_type = 2 AND weid=:weid AND storeid={$storeid} AND type<>4", array(':weid' => $weid));

    //优惠券券
    $coupon_count1 = pdo_fetchcolumn("SELECT COUNT(1) FROM " . tablename($this->table_coupon) . " WHERE type = 1 AND type<>4 AND weid=:weid AND storeid={$storeid} ", array(':weid' => $weid));
    //代金券
    $coupon_count2 = pdo_fetchcolumn("SELECT COUNT(1) FROM " . tablename($this->table_coupon) . " WHERE type = 2 AND type<>4 AND weid=:weid AND storeid={$storeid} ", array(':weid' => $weid));
    //优惠券券
    $coupon_count3 = pdo_fetchcolumn("SELECT COUNT(1) FROM " . tablename($this->table_coupon) . " WHERE type = 3 AND type<>4 AND weid=:weid AND storeid={$storeid} ", array(':weid' => $weid));
} else if ($operation == 'post') {
    $id = intval($_GPC['id']);
    $reply = pdo_fetch("select * from " . tablename($this->table_coupon) . " where id = :id AND weid=:weid
            LIMIT 1", array(':id' => $id, ':weid' => $weid));
    if (!empty($reply)) {
        if (!empty($reply['thumb'])) {
            $thumb = tomedia($reply['thumb']);
        }
    }

    if (!empty($reply)) {
        $starttime = date('Y-m-d H:i', $reply['starttime']);
        $endtime = date('Y-m-d H:i', $reply['endtime']);
    } else {
        $starttime = date('Y-m-d H:i');
        $endtime = date('Y-m-d H:i', TIMESTAMP + 86400 * 30);
    }

    //等级
//            $levels = pdo_fetchall("SELECT * FROM " . tablename($this->table_level) . " WHERE weid = :weid order by max", array(':weid' => $_W['uniacid']));

    if (checksubmit('submit')) {
        $data = array(
            'weid' => intval($_W['uniacid']),
            'title' => trim($_GPC['title']),
            'storeid' => $storeid,
            'content' => trim($_GPC['content']),
            'thumb' => trim($_GPC['thumb']),
//                    'levelid' => intval($_GPC['levelid']),
            'totalcount' => intval($_GPC['totalcount']),
            'usercount' => intval($_GPC['usercount']),
            'type' => intval($_GPC['type']),
            'attr_type' => intval($_GPC['attr_type']),
            'gmoney' => intval($_GPC['gmoney']),
            'dmoney' => intval($_GPC['dmoney']),
            'starttime' => strtotime($_GPC['datelimit']['start']),
            'endtime' => strtotime($_GPC['datelimit']['end']),
            'displayorder' => intval($_GPC['displayorder']),
            'dateline' => TIMESTAMP,
        );

        if (istrlen($data['title']) == 0) {
            message('没有输入标题.', '', 'error');
        }
        if (istrlen($data['title']) > 30) {
            message('标题不能多于30个字。', '', 'error');
        }

        if ($data['count'] < 0) {
            message('优惠券张数不能小于于0.', '', 'error');
        }
        if ($data['count'] > 10000) {
            message('优惠券张数不能大于10000.', '', 'error');
        }
        if ($data['count'] < 0) {
            message('优惠券总张数不能小于于0.', '', 'error');
        }

        if (!empty($reply)) {
            unset($data['dateline']);
            pdo_update($this->table_coupon, $data, array('id' => $id, 'weid' => $_W['uniacid']));
        } else {
            pdo_insert($this->table_coupon, $data);
        }
        message('操作成功!', $url);
    }
} else if ($operation == 'delete') {
    $id = intval($_GPC['id']);
    if ($id > 0) {
        pdo_delete($this->table_coupon, array('id' => $id, 'weid' => $_W['uniacid']));
    }
    message('操作成功!', $url);
}

include $this->template('web/coupon');