<?php
//$client_id = "3eba5784073f743";
//function curl_get_contents($url)
//{
//    $ch = curl_init();
//
//    curl_setopt($ch, CURLOPT_HEADER, 0);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//    curl_setopt($ch, CURLOPT_URL, $url);
//
//    $data = curl_exec($ch);
//    curl_close($ch);
//
//    return $data;
//}
//
//
//function print_pre($obj)
//{
//    ?>
<!--    <pre>-->
<!--        --><?// print_r($obj); ?>
<!--    </pre>-->
<!--    --><?php
//}
//
//
//$_card = 0;
//function getImages($imgurCode, $setNum, $subSetNum = 0)
//{
//    $this->_card = $subSetNum == 0 ? 0 : $this->_card;
//    //TODO - do this for all sets (make an array of arrays with all numbers
//    $magnumOpsNums = array(1,11,13, 27, 45, 54);
//    $client_id = "3eba5784073f743";
//    $imgs = array();
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/album/' . $imgurCode . '/images');
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//    curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Authorization: Client-ID ' . $client_id ));
//
//    $reply = curl_exec($ch);
//
//    $obj = json_decode($reply);
//    //print_pre($obj);
//    for($x = 0; $x < sizeof($obj->data); $x++)
//    {
//        $cardNum = $setNum == 0 ? $x + 5 : $x + 1;
//        $cardNum = $setNum == 23 ? $magnumOpsNums[$x] : $cardNum;
//        $this->_card = $cardNum;
//
//
//        if($setNum == 23 && ($x + 1) > sizeof($magnumOpsNums)) continue;
//
//        $s = array(
//            "netrunnerdb_code" => sprintf('%02d', $setNum) . sprintf('%03d', $_card),
//            "link" => substr($obj->data[$x]->link,strlen("https://i.imgur.com/"))
//        );
//
//        array_push($imgs, $s);
//    }
//
//    curl_close($ch);
//    return $imgs;
//}