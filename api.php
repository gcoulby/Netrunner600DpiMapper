<?php
require_once "functions.php";

$imgurUrl = "https://imgur.com/a/";

$url = "https://netrunnerdb.com/api/2.0/public/cards";

$imgurLinks = array(
    "npYzm",
    "jUP2K",
    array(
        "FcFWuRK",
        "C9IUM07",
        "TSft0sL",
        "UsA2apr",
        "rNpQFNm",
        "3NduNJY"
    ),
    "2zF7h8m",
    array(
        "SXAUZQE",
        "ARdFWIK",
        "hNiZGiG",
        "F8BwRV4",
        "4Z9aMTT",
        "cZ2lcUl"
    ),
    "llvzQ5x",
    array(
        "vAmfYHj",
        "Ps1jADH",
        "xKXJjyj",
        "jsP3y32",
        "WTIuxOx",
        "Eui7Dtb"
    ),
    "sVTLIW0",
    array(
        "JmTr7SY",
        "d1XXlGi",
        "Sms4c08",
        "E3Ye2Gl",
        "4HBtjCn",
        "MX1eEsB"
    ),
    "0nE9EUf",
    array(
        "XfMFimB",
        "xH09kKZ",
        "DNWPA8x",
        "bgJtupi",
        "fCSagR8",
        "G2lzRb4"
    ),
    array(
        "U4SDFhL",
        "QPPBDAU",
        "1UoQDwT",
        "zD6wDaK",
        "X3WlQO0",
        "wUGVOG5"
    ),
    array(
        "lqHciOW",
        "JB8L6dp",
        "Zfsw2Vi",
        "0GNrF5Y",
        "BjQ8e5b",
        "6DTifdK"
    ),
    "So2tnbZ",
    "pyW0T",
    array(
        "sYWqN",
        "sEGaC",
        "cqZZc",
        "tkbIP",
        "7RogF4H",
        "ZFD3gtw"
    ),
    "zDOAMEM",
    "FuSjpQh"
);

$imgArr = array(
    "imageUrlTemplate" => "https://i.imgur.com/{link}",
    "data" => array()
);


$client_id = "3eba5784073f743";
$api_secret = "ba0f9d5179869c0be8890e53f8da13e305ecea0d";

for($i = 0; $i<sizeof($imgurLinks);$i++)
{
    $setNum = $i > 13 && $i < 20 ? $i + 6 : $i;

    $type = gettype($imgurLinks[$i]);
    if($type == "string")
    {
        $imgs =  getImages($imgurLinks[$i], $setNum);

        foreach ($imgs as $img)
        {
            array_push($imgArr["data"], $img);
        }
    }
    else
    {
        for($j = 0;$j<sizeof($imgurLinks[$i]);$j++)
        {
            $imgs =  getImages($imgurLinks[$i][$j], $setNum);
            foreach ($imgs as $img)
            {
                array_push($imgArr["data"], $img);
            }
        }
    }
}
echo json_encode($imgArr, JSON_UNESCAPED_SLASHES);
//print_pre($imgArr);












$data = curl_get_contents($url);



$json = curl_get_contents($url);
$obj = json_decode($json);

//print_pre($obj);
//echo $obj->access_token;


