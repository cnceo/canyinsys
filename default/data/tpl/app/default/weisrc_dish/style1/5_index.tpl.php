<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <meta name="keywords" content="美食,团购,外卖,网上订餐,酒店,旅游,电影票,火车票,飞机票">
    <meta name="description" content="美食攻略,外卖网上订餐,酒店预订,旅游团购,飞机票火车票,电影票,ktv团购吃喝玩乐全都有!店铺信息查询,商家评分/评价一站式生活服务网站">
    <title><?php  echo $setting['title'];?></title>
    <link rel="stylesheet" href="<?php echo RES;?>/plugin/light7/light7.min.css">
    <link rel="stylesheet" type="text/css" href="<?php  echo $this->cur_mobile_path?>/css/api.css"/>
    <link rel="stylesheet" type="text/css" href="<?php  echo $this->cur_mobile_path?>/css/common.css?v=7"/>
    <link rel="stylesheet" href="<?php  echo $this->cur_mobile_path?>/css/swiper.css">
    <link rel="stylesheet" href="<?php  echo $this->cur_mobile_path?>/css/index.css?v=2">
    <link rel="stylesheet" type="text/css" href="<?php  echo $this->cur_mobile_path?>/css/fakeLoader.css">
    <link rel="stylesheet" type="text/css" href="<?php  echo $this->cur_mobile_path?>/css/iconfont.css"/>
    <script src="<?php  echo $this->cur_mobile_path?>/script/jquery-1.8.3.min.js"></script>
</head>
<body>
<div class="fakeloader"></div>

<?php  $url_search = $this->createMobileUrl('search', array(), true);?>
<?php  $url_user = $this->createMobileUrl('usercenter', array(), true);?>
<div class="wrap" style="height:100%;overflow: scroll;padding-bottom: 70px;overflow-y:scroll;-webkit-overflow-scrolling:touch;">
    <div id="header">
        <div class="search" tapmode="topbar-active" onclick="javascript:window.location.href='<?php  echo $url_search;?>'">
            <i class="i-search"></i>
        </div>
        <div class="flex-full"><?php  echo $setting['title'];?></div>
        <div class="map" tapmode="topbar-active"  onclick="javascript:window.location.href='<?php  echo $url_user;?>'">
            <i class="i-user"></i>
        </div>
    </div>
    <div id="main" style="margin-top:44px;"  >
        <?php  if(!empty($slide)) { ?>
        <div class="sw1">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php  if(is_array($slide)) { foreach($slide as $item) { ?>
                    <div class="swiper-slide">
                        <a href="<?php  if(empty($item['url'])) { ?>#<?php  } else { ?><?php  echo $item['url'];?><?php  } ?>">
                            <img src="<?php  echo tomedia($item['thumb'])?>" onerror="this.src='<?php echo RES;?>/themes/images/nopic.jpeg'" width="100%"/>
                        </a>
                    </div>
                    <?php  } } ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <?php  } ?>
        <!-- Swiper -->
        <?php  if($typecount>=0) { ?>
        <div class="sw2">
        <div class="box swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <ul>
                        <li>
                            <?php  $_data_index = 0;?>
                            <?php  if(is_array($shoptypes)) { foreach($shoptypes as $item) { ?>
                            <?php  if($_data_index==8) { ?><?php  break;?><?php  } ?>
                            <div class="slide-nav" <?php  if($_data_index==4) { ?>style="float:left;clear:left;"<?php  } ?>>
                                <a href="<?php  if(empty($item['url'])) { ?><?php  echo $this->createMobileurl('waprestlist', array('typeid' => $item['id']), true)?><?php  } else { ?><?php  echo $item['url'];?><?php  } ?>"><i class="i-nav i-nav-<?php  echo $_data_index;?>" <?php  if($item['thumb']) { ?> style="background:url(<?php  echo tomedia($item['thumb']);?>) no-repeat center top;-webkit-background-size: 40px;background-size: 40px;"<?php  } ?>></i><div class="slide-nav-text"><?php  echo $item['name'];?></div>
                                </a>
                            </div>
                            <?php  $_data_index++;?>
                            <?php  } } ?>
                        </li>
                    </ul>
                </div>
                <?php  if($typecount>8) { ?>
                <div class="swiper-slide">
                    <ul>
                        <li>
                            <?php  $_data_index = 0;?>
                            <?php  if(is_array($shoptypes)) { foreach($shoptypes as $item) { ?>
                            <?php  if($_data_index>8) { ?>
                            <div class="slide-nav" <?php  if($_data_index==4) { ?>style="float:left;clear:left;"<?php  } ?>>
                                <a href="<?php  if(empty($item['url'])) { ?><?php  echo $this->createMobileurl('waprestlist', array('typeid' => $item['id']), true)?><?php  } else { ?><?php  echo $item['url'];?><?php  } ?>"><i class="i-nav i-nav-<?php  echo $_data_index;?>" <?php  if($item['thumb']) { ?> style="background: url(<?php  echo tomedia($item['thumb']);?>) no-repeat center top;-webkit-background-size: 40px;background-size: 40px;"<?php  } ?>></i><div class="slide-nav-text"><?php  echo $item['name'];?></div>
                                </a>
                            </div>
                            <?php  } ?>
                            <?php  $_data_index++;?>
                            <?php  } } ?>
                        </li>
                    </ul>
                </div>
                <?php  } ?>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div>
        </div>
        <?php  } ?>
        <!-- 首页列表 -->
        <div class="box item-list">
            <h2><i class="i-shop"></i>附近商家</h2>
            <?php  if(is_array($restlist)) { foreach($restlist as $item) { ?>
            <?php  if($item['default_jump']==1) { ?>
            <?php  $url = $this->createMobileUrl('detail', array('id' => $item['id']), true);?>
            <?php  } else if($item['default_jump']==2) { ?>
            <?php  $url = $this->createMobileUrl('waplist', array('storeid' => $item['id'], 'mode' => 2), true);?>
            <?php  } else if($item['default_jump']==3) { ?>
            <?php  $url = $this->createMobileUrl('waplist', array('storeid' => $item['id'], 'mode' => 4), true);?>
            <?php  } else if($item['default_jump']==4) { ?>
            <?php  $url = $this->createMobileUrl('queue', array('storeid' => $item['id']), true);?>
            <?php  } else if($item['default_jump']==5) { ?>
            <?php  $url = $this->createMobileUrl('reservationIndex', array('storeid' => $item['id'], 'mode' => 3), true);?>
            <?php  } else if($item['default_jump']==6) { ?>
            <?php  $url = $item['default_jump_url'];?>
            <?php  } ?>
            <section class="item" onclick="location.href='<?php  echo $url;?>'">
                <div class="left-wrap">
                    <img class="logo" src="<?php  echo tomedia($item['logo']);?>" onerror="this.src='<?php  echo tomedia('./addons/weisrc_dish/icon.jpg');?>'">
                    <?php  if($item['is_rest'] == 0) { ?>
                    <span class="status-tip" style="background-color: rgb(192, 192, 192);"> 商家休息 </span>
                    <?php  } ?>
                </div>
                <div class="right-wrap">
                    <section class="line">
                        <h3 class="shopname<?php  if($item['is_brand']==1) { ?> premium<?php  } ?>"><?php  echo $item['title'];?></h3>
                        <div class="support-wrap">
                            <?php  if($item['is_meal']==1) { ?>
                            <div class="activity-wrap nowrap">
                                <i class="activity-icon icononly"
                                   style="color: rgb(153, 153, 153); border-color: rgb(221, 221, 221);"> 店 </i>
                            </div>
                            <div class="tag label-red ng-scope"></div>
                            <?php  } ?>
                            <?php  if($item['is_delivery']==1) { ?>
                            <div class="activity-wrap nowrap">
                                <i class="activity-icon icononly"
                                   style="color: rgb(153, 153, 153); border-color: rgb(221, 221, 221);"> 外 </i>
                            </div>
                            <?php  } ?>
                        </div>
                    </section>
                    <section class="line">
                        <div class="rate-wrap">
                       	<span>
                            <?php  for($i=0;$i < $item['level']; $i++){ ?>
                            <i class="i-star i-star-gold"></i>
                            <?php  }?>
                            <!--<i class="i-star i-star-gold"></i>-->
                            <!--<i class="i-star i-star-gold"></i>-->
                            <!--<i class="i-star i-star-gold"></i>-->
                            <!--<i class="i-star i-star-gray">-->
                                <!--<i class="i-star i-star-gold"></i>-->
                            <!--</i>-->
                            <!--<i class="i-star i-star-gray"></i>-->
                        </span>
                            <!--<span class="rate">4.6</span>-->
                            <?php  if($item['sales']>0) { ?>
                            <span>已售<?php  echo $item['sales'];?>份</span>
                            <?php  } ?>
                        </div>
                        <div class="delivery-wrap">
                            <span class="icon-delivery">准时达</span>
                        </div>
                    </section>
                    <section class="line">
                        <div class="moneylimit">
                            <?php  if($item['is_delivery']==1) { ?>
                            <?php  if(!empty($item['sendingprice'])) { ?>
                            <span>¥<?php  echo $item['sendingprice'];?>起送</span>
                            <?php  } ?>
                            <?php  if($item['dispatchprice']>0) { ?>
                            <span>配送费约¥<?php  echo $item['dispatchprice'];?></span>
                            <?php  } else { ?>
                            <span>免配送费</span>
                            <?php  } ?>
                            <?php  if($item['freeprice']!=0.00) { ?>
                            <span>满<?php  echo intval($item['freeprice'])?>免配送费</span>
                            <?php  } ?>
                            <?php  } else { ?>
                            <span><?php  echo $item['address'];?></span>
                            <?php  } ?>
                        </div>
                        <div class="timedistance-wrap">
                            <span class="distance-wrap"><?php  echo $this->getDistance($item['lat'], $item['lng'], $lat, $lng).'km';?></span>
                            <!--<span class="time-wrap">42分钟</span>-->
                        </div>
                    </section>
                </div>
            </section>
            <?php  } } ?>
        </div>
        <input type="hidden" id="curlat" name="curlat" value="0"/>
        <input type="hidden" id="curlng" name="curlng" value="0"/>
        <input type="hidden" id="isposition" name="isposition" value="<?php  echo $isposition;?>" />
        <input type="hidden" id="cururl" name="cururl" value="<?php  echo $this->createMobileurl('index', array(), true)?>" />
        <?php  include $this->template($this->cur_tpl.'/_pop');?>
        <div class="top-btn" style="display: block;">
            <a class="react">
                <i class="text-icon">⇧</i>
            </a>
        </div>
        <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=5PESLgvMcSbSUbPjmDKgvGZ3"></script>
        <script type="text/javascript" src="../addons/weisrc_dish/template/js/postion.js?v=3"></script>
        <script>
            //top行为
            $('.top-btn').on('click', function () {
                $("html, body").animate({scrollTop: 0}, "slow");
            });
            if ($(document).scrollTop() == 0) {
                $('.top-btn').css('display', 'none');
            }
            $(document).bind('scroll', function () {
                if ($(document).scrollTop() == 0) {
                    $('.top-btn').css('display', 'none');
                } else {
                    $('.top-btn').css('display', 'block');
                }
            })
        </script>
        <script type="text/javascript" src="<?php  echo $this->cur_mobile_path?>/script/api.js"></script>
        <script type="text/javascript" src="<?php  echo $this->cur_mobile_path?>/script/swiper.min.js"></script>
        <script type="text/javascript">
            var swiper = new Swiper('.sw1 .swiper-container', {
                pagination: '.sw1 .swiper-pagination',
                paginationClickable: true,
                autoplay: 3000
            });

            var swiper = new Swiper('.sw2 .swiper-container', {
                pagination: '.sw2 .swiper-pagination',
                paginationClickable: true
            });
        </script>
        <script src="<?php  echo $this->cur_mobile_path?>/script/fakeLoader.min.js"></script>
        <script type="text/javascript">
//            $(document).ready(function () {
//                $(".fakeloader").fakeLoader({
//                    timeToHide: 1200,
//                    bgColor: "#1abc9c",
//                    spinner: "spinner6"
//                });
//            });
        </script>
    </div>
</div>
<?php  include $this->template($this->cur_tpl.'/_nave');?>
<?php  include $this->template($this->cur_tpl.'/_statistics');?>
</body>
</html>
