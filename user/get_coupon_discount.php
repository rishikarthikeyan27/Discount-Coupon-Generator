<?php
include 'callAPI.php';
include 'admin_token.php';

$contentBodyJson = file_get_contents('php://input');
$content = json_decode($contentBodyJson, true);
$coupon_code = $content['promocode'];
error_log($coupon_code);

$baseUrl = getMarketplaceBaseUrl();
$admin_token = getAdminToken();
$customFieldPrefix = getCustomFieldPrefix();
// 'Operator' => 'equal', 
$coupon_details = array(array('Name' => 'CouponCode', 'Value' => $coupon_code));
$url =  $baseUrl . '/api/v2/plugins/'. getPackageID() .'/custom-tables/Coupon';
$couponDetails =  callAPI("POST", $admin_token['access_token'], $url, $coupon_details);
echo json_encode(['result' => $couponDetails['Records']]);

?>