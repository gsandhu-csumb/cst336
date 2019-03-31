<?php
$promoCode = $_GET['code'];
$codes = array();
$codesArray = array();
$codes["code"] = "getFifty";
array_push($codesArray, $codes);
$codes["code"] = "halfPrice";
array_push($codesArray, $codes);
$codes["code"] = "sand30";
array_push($codesArray, $codes);
$codes["code"] = "spring30";
array_push($codesArray, $codes);
$codes["code"] = "beach";
array_push($codesArray, $codes);
$codes["code"] = "sunny";
array_push($codesArray, $codes);
if ($promoCode == "getFifty" || $promoCode == "halfPrice"){
    echo 0.5;
}
else if ($promoCode == "sand30" || $promoCode == "spring30"){
    echo 0.3;
}
else if ($promoCode == "beach" || $promoCode == "sunny"){
    echo 0.2;    
}
else {
    echo 1;
}
echo json_encode($codesArray[rand(0,5)]);
?>