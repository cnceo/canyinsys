<?php
global $_W, $_GPC;
$weid = $this->_weid;
$from_user = $this->_fromuser;
$couponid = intval($_GPC['couponid']);

$coupon = pdo_fetch("SELECT a.*,b.sncode,b.id AS couponid FROM " . tablename($this->table_coupon) . "
        a INNER JOIN " . tablename($this->table_sncode) . " b ON a.id= b.couponid
 WHERE a.weid = :weid AND b.from_user=:from_user AND b.status=0 AND :time<a.endtime AND b.id=:couponid ORDER BY b.id
 DESC LIMIT 1", array(':weid' => $weid, ':from_user' => $from_user, ':time' => TIMESTAMP, ':couponid' => $couponid));

if (empty($coupon)) {
    $result['status'] = 0;
    echo json_encode($result);
    exit;
}
if ($coupon['type'] == 1) { //商品
    $result['status'] = 0;
    echo json_encode($result);
    exit;
}

$result['status'] = 1;
$result['dprice'] = $coupon['dmoney'];
echo json_encode($result);
exit;