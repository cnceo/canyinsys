<?php
global $_W, $_GPC;
$weid = $this->_weid;
$from_user = $this->_fromuser;
$title = '我的菜单';
$do = 'menu';
$storeid = intval($_GPC['storeid']);
$orderid = intval($_GPC['orderid']);
$mode = intval($_GPC['mode']);
$append = intval($_GPC['append']);
if ($mode == 0) {
    message('请先选择下单模式', $this->createMobileUrl('detail', array('id' => $storeid)));
}

$user = pdo_fetch("SELECT * FROM " . tablename($this->table_fans) . " WHERE weid = :weid  AND from_user=:from_user ORDER BY `id` DESC limit 1", array(':weid' => $weid, ':from_user' => $from_user));
if ($user['status'] == 0) {
    message('你被禁止下单,不能进行相关操作...');
}

if (empty($storeid)) {
    message('请先选择门店', $this->createMobileUrl('waprestlist'));
}

$method = 'wapmenu'; //method
$authurl = $_W['siteroot'] . 'app/' . $this->createMobileUrl($method, array('storeid' => $storeid, 'mode' => $mode), true) . '&authkey=1';
$url = $_W['siteroot'] . 'app/' . $this->createMobileUrl($method, array('storeid' => $storeid, 'mode' => $mode), true);
if (isset($_COOKIE[$this->_auth2_openid])) {
    $from_user = $_COOKIE[$this->_auth2_openid];
    $nickname = $_COOKIE[$this->_auth2_nickname];
    $headimgurl = $_COOKIE[$this->_auth2_headimgurl];
} else {
    if (isset($_GPC['code'])) {
        $userinfo = $this->oauth2($authurl);
        if (!empty($userinfo)) {
            $from_user = $userinfo["openid"];
            $nickname = $userinfo["nickname"];
            $headimgurl = $userinfo["headimgurl"];
        } else {
            message('授权失败!');
        }
    } else {
        if (!empty($this->_appsecret)) {
            $this->getCode($url);
        }
    }
}
if (empty($from_user)) {
    message('会话已过期，请重新发送关键字!');
}

$this->resetHour();
$store = $this->getStoreById($storeid);
if ($store['is_rest'] != 1) {
    message('门店休息中!');
}
$iscard = $this->get_sys_card($from_user);

$over_radius = 0;
if ($mode == 2) {
    //距离
    $delivery_radius = floatval($store['delivery_radius']);
    $distance = $this->getDistance($user['lat'], $user['lng'], $store['lat'], $store['lng']);
    $distance = floatval($distance);
    if ($store['not_in_delivery_radius'] == 0) { //只能在距离范围内
        if ($distance > $delivery_radius) {
            $over_radius = 1;
        }
    }
}

$mealtimes = pdo_fetchall("SELECT * FROM " . tablename($this->table_mealtime) . " WHERE weid=:weid AND storeid=:storeid ORDER BY id ASC", array(':weid' => $weid, ':storeid' => $storeid));

$dispatchareas = pdo_fetchall("SELECT * FROM " . tablename($this->table_dispatcharea) . " WHERE weid=:weid AND storeid=:storeid ORDER BY id ASC", array(':weid' => $weid, ':storeid' => $storeid));

$select_mealdate = '';
if (!empty($store['delivery_within_days'])) {
    $delivery_within_days = intval($store['delivery_within_days']) + 1;
    for ($i = 0; $i < $delivery_within_days; $i++) {
        $date_title = '';
        if ($i == 0) {
            if ($store['delivery_isnot_today'] == 1) {
                continue;
            }
            $date_value = date("Y-m-d", TIMESTAMP);
            $date_title = '今日';
        } elseif ($i == 1) {
            $date_value = date("Y-m-d", strtotime("+{$i} day"));
            $date_title = '明日';
        } else {
            $date_value = date("Y-m-d", strtotime("+{$i} day"));
            $date_title = date("Y-m-d", strtotime("+{$i} day"));
        }

        $select_mealdate .= "<option value='{$date_value}'>{$date_title}</option>";
    }
}
$select_mealtime = '';
$select_mealtime2 = '';
$cur_date = date("Y-m-d", TIMESTAMP);
foreach ($mealtimes as $key => $value) {
    $begintime = intval(strtotime(date('Y-m-d ') . $value['begintime']));
    $endtime = intval(strtotime(date('Y-m-d ') . $value['endtime']));
    if ($store['delivery_isnot_today'] == 1) {
        $select_mealtime .= '<option value="' . $value['begintime'] . '~' . $value['endtime'] . '">' . $value['begintime'] . '~' . $value['endtime'] . '</option>';
    } else {
//        if ($begintime > TIMESTAMP) {//debug
//            $select_mealtime .= '<option value="' . $value['begintime'] . '~' . $value['endtime'] . '">' . $value['begintime'] . '~' . $value['endtime'] . '</option>';
//        }
        if (TIMESTAMP < $endtime) {//debug
            $select_mealtime .= '<option value="' . $value['begintime'] . '~' . $value['endtime'] . '">' . $value['begintime'] . '~' . $value['endtime'] . '</option>';
        }
    }

    $select_mealtime2 .= '<option value="' . $value['begintime'] . '~' . $value['endtime'] . '">' . $value['begintime'] . '~' . $value['endtime'] . '</option>';
}
if (empty($select_mealtime)) {
    $select_mealtime = '<option value="休息中">没在配送时间内</option>';
}

$flag = false;
$issms = intval($store['is_sms']);
$checkcode = pdo_fetch("SELECT * FROM " . tablename('weisrc_dish_sms_checkcode') . " WHERE weid = :weid  AND from_user=:from_user AND status=1 ORDER BY `id` DESC limit 1", array(':weid' => $weid, ':from_user' => $from_user));
if ($issms == 1 && empty($checkcode)) {
    $flag = true;
}

$setting = $this->getSetting();

$cart = pdo_fetchall("SELECT * FROM " . tablename($this->table_cart) . " a LEFT JOIN " . tablename('weisrc_dish_goods') . " b ON a.goodsid=b.id WHERE a.weid=:weid AND a.from_user=:from_user AND a.storeid=:storeid", array(':weid' => $weid, ':from_user' => $from_user, ':storeid' => $storeid));

$packvalue = 0;
foreach ($cart as $key => $value) {
    $packvalue = $packvalue + $value['total'] * $value['packvalue'];
}

$cart2 = pdo_fetchall("SELECT * FROM " . tablename($this->table_cart) . " WHERE  storeid=:storeid AND from_user=:from_user AND weid=:weid", array(':storeid' => $storeid, ':from_user' => $from_user, ':weid' => $weid));
$totalcount = 0;
$totalprice = 0;
$goodsprice = 0;
foreach ($cart2 as $key => $value) {
    $totalcount = $totalcount + $value['total'];
    $totalprice = $totalprice + $value['total'] * $value['price'];
    $goodsprice = $goodsprice + $value['total'] * $value['price'];
}

$jump_url = $this->createMobileurl('wapmenu', array('from_user' => $from_user, 'storeid' => $storeid), true);
$limitprice = 0;
if ($mode == 1) { //店内
    $tablesid = intval($_GPC['tablesid']);
    $table = pdo_fetch("SELECT * FROM " . tablename($this->table_tables) . " where weid = :weid AND id=:id LIMIT 1", array(':weid' => $weid, ':id' => $tablesid));
    if (empty($table)) {
        exit('餐桌不存在！');
    } else {
        //餐桌类型
        $tablezones = pdo_fetch("SELECT * FROM " . tablename($this->table_tablezones) . " where weid = :weid AND id=:id LIMIT 1", array(':weid' => $weid, ':id' => $table['tablezonesid']));
        if (empty($tablezones)) {
            exit('餐桌类型不存在！');
        }
        $table_title = $tablezones['title'] . '-' . $table['title'];
        if ($append == 0) {
            $limitprice = floatval($tablezones['limit_price']);
        }
        $service_rate = floatval($tablezones['service_rate']);
    }

    //茶位费
    $is_tea_money = intval($store['is_tea_money']);
    $teatip = empty($store['tea_tip']) ? "茶位费用" : $store['tea_tip'];
    $teavaule = 0;
    if ($is_tea_money == 1) {
        $default_user_count = intval($store['default_user_count']);
        $teavaule = floatval($store['tea_money']);
        $totalteavalue = $append != 0 ? 0 : $teavaule * $default_user_count;
    }
} elseif ($mode == 2) { //外卖
    $limitprice = floatval($store['sendingprice']);
    $jump_url = $this->createMobileurl('wapmenu', array('from_user' => $from_user, 'storeid' => $storeid, 'mode' => 2), true);
} elseif ($mode == 5) {//排队
    $jump_url = $this->createMobileurl('queue', array('from_user' => $from_user, 'storeid' => $storeid), true);
}

if (!empty($from_user) && !(empty($weid))) {
    $order = pdo_fetch("SELECT * FROM " . tablename($this->table_order) . " WHERE weid=:weid AND from_user=:from_user ORDER BY id DESC LIMIT 1", array(':from_user' => $from_user, ':weid' => $weid));
}

$couponlist = pdo_fetchall("SELECT a.*,b.sncode,b.id AS couponid FROM " . tablename($this->table_coupon) . "
        a INNER JOIN " . tablename($this->table_sncode) . " b ON a.id= b.couponid
 WHERE a.weid = :weid AND b.from_user=:from_user AND a.storeid=:storeid AND b.status=0 AND :price>=a.gmoney AND
 :time<a.endtime ORDER BY b.id DESC LIMIT 30", array(':weid' => $weid, ':from_user' => $from_user, ':price' => $totalprice, ':time' => TIMESTAMP, ':storeid' => $storeid));

$is_auto_address = intval($setting['is_auto_address']);

$share_title = !empty($setting['share_title']) ? str_replace("#username#", $nickname, $setting['share_title']) : "您的朋友{$nickname}邀请您来吃饭";
$share_desc = !empty($setting['share_desc']) ? str_replace("#username#", $nickname, $setting['share_desc']) : "最新潮玩法，快来试试！";
$share_image = !empty($setting['share_image']) ? tomedia($setting['share_image']) : tomedia("../addons/weisrc_dish/icon.jpg");
$share_url = $_W['siteroot'] . 'app/' . $this->createMobileUrl('usercenter', array('agentid' => $fans['id']), true);



include $this->template($this->cur_tpl . '/menu');