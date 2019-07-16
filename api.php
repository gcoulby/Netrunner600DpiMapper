<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 'on');
//require_once "functions.php";

class Api{

    private $url = "https://netrunnerdb.com/api/2.0/public/cards";
    private $imgurLinks = array(
        "dnrQtbS",
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
        "dw7eUom",
        array(
            "sYWqN",
            "sEGaC",
            "cqZZc",
            "tkbIP",
            "7RogF4H",
            "ZFD3gtw"
        ),
        "zDOAMEM",
        "sdjjrKC"
    );

    private $imgArr = array(
        "imageUrlTemplate" => "http://i.imgur.com/{link}",
        "data" => array()
    );

    private $client_id = "3eba5784073f743";
    private $api_secret = "ba0f9d5179869c0be8890e53f8da13e305ecea0d";
    private $dbArr = array();
    private $_card = 0;



    function __construct()
    {
        $json = $this->curl_get_contents($this->url);
        $obj = json_decode($json);

        foreach ($obj->data as $d)
        {
            $this->dbArr[$d->code]["title"] = $d->title;
            $this->dbArr[$d->code]["quantity"] = $d->quantity;
            $this->dbArr[$d->code]["side_code"] = $d->side_code;
        }
        $this->BuildModel();
        $this->PrintJson();
    }

    function BuildModel()
    {
        for($i = 0; $i<sizeof($this->imgurLinks);$i++)
        {
            $setNum = $i > 13 && $i < 20 ? $i + 6 : $i;

            $type = gettype($this->imgurLinks[$i]);
            if($type == "string")
            {
                $imgs = $this->getImages($this->imgurLinks[$i], $setNum);
                $this->ProcessImages($imgs);
            }
            else
            {
                for($j = 0;$j<sizeof($this->imgurLinks[$i]);$j++)
                {
                    $imgs = $this->getImages($this->imgurLinks[$i][$j], $setNum, $j);
                    $this->ProcessImages($imgs);
                }
            }
        }
        $this->AddSupportCards();
    }

    function ProcessImages($imgs)
    {
        foreach ($imgs as $img)
        {
            $cardData = isset($this->dbArr[$img["netrunnerdb_code"]]) ? $this->dbArr[$img["netrunnerdb_code"]] : null;
            if($cardData != null)
            {
                $img["title"] = $this->dbArr[$img["netrunnerdb_code"]]["title"];
                $img["quantity"] = $this->dbArr[$img["netrunnerdb_code"]]["quantity"];
                $img["side_code"] = $this->dbArr[$img["netrunnerdb_code"]]["side_code"];
            }
//                        $this->print_pre($img);
            array_push($this->imgArr["data"], $img);
        }
    }

    function AddSupportCards()
    {
        $imgs = array(
            array(
                "netrunnerdb_code" => "99001",
                "link" => "bZyWAJ2.jpg",
                "title" => "Corp Support",
                "quantity" => 1,
                "side_code" => "corp",
            ),
            array(
                "netrunnerdb_code" => "99002",
                "link" => "ch4atKS.jpg",
                "title" => "Runner Support",
                "quantity" => 1,
                "side_code" => "runner",
            ),
            array(
                "netrunnerdb_code" => "99003",
                "link" => "yvvlclp.jpg",
                "title" => "Runner Clicker",
                "quantity" => 1,
                "side_code" => "runner",
            ),
            array(
                "netrunnerdb_code" => "99004",
                "link" => "qDYEB1T.jpg",
                "title" => "Corp Clicker",
                "quantity" => 1,
                "side_code" => "corp",
            ),
            array(
                "netrunnerdb_code" => "99005",
                "link" => "bSIMofI.jpg",
                "title" => "Corp Back",
                "quantity" => 1,
                "side_code" => "corp",
            ),
            array(
                "netrunnerdb_code" => "99006",
                "link" => "8U05eV5.jpg",
                "title" => "Runner Back",
                "quantity" => 1,
                "side_code" => "runner",
            ),
            array(
                "netrunnerdb_code"=> "99007",
                "title" => "Runner Back White",
                "side_code"=> "runner",
                "quantity"=> 1,
                "link"=> "sVrH8Fn.png"
            ),
            array(
                "netrunnerdb_code"=> "99008",
                "title" => "Corp Back White",
                "side_code"=> "corp",
                "quantity"=> 1,
                "link"=> "g7uYUE6.png"
            ),
            array(
                "netrunnerdb_code"=> "99009",
                "title" => "Blank Back White",
                "side_code"=> "blank",
                "quantity"=> 1,
                "link"=> "DirA0T2.png"
            )
        );

        foreach ($imgs as $img)
        {
            array_push($this->imgArr["data"], $img);
        }
    }

    function PrintJson()
    {
        echo json_encode($this->imgArr, JSON_UNESCAPED_SLASHES);
    }


    function getImages($imgurCode, $setNum, $subSetNum = 0)
    {
        $this->_card = $subSetNum == 0 ? 0 : $this->_card;

        $magnumOpsNums = array(1,11,13, 27, 45, 54);

        $imgs = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/album/' . $imgurCode . '/images');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Authorization: Client-ID ' . $this->client_id ));

        $reply = curl_exec($ch);

        $obj = json_decode($reply);
        //print_pre($obj);
        for($x = 0; $x < sizeof($obj->data); $x++)
        {
//            echo $x . "</br>";
            switch ($setNum)
            {
                case 0:
                    $cardNum = $x + 5;
                    break;
                case 23:
                    $cardNum = $magnumOpsNums[$x];
                    break;
                default:
                    $cardNum = $this->_card + 1;
                    break;
            }
//            $cardNum = $setNum == 0 ? $x + 5 : $x + 1;
//            $cardNum = $setNum == 23 ? $magnumOpsNums[$x] : $cardNum;
            $this->_card = $cardNum;
//            echo $this->_card . "</br>";
            if($setNum == 23 && ($x + 1) > sizeof($magnumOpsNums)) continue;

            $s = array(
                "netrunnerdb_code" => sprintf('%02d', $setNum) . sprintf('%03d', $this->_card),
                "link" => substr($obj->data[$x]->link,strlen("https://i.imgur.com/"))
            );

            array_push($imgs, $s);
//            echo $x . "</br>";
        }

        curl_close($ch);
        return $imgs;
    }

    function curl_get_contents($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }


    function print_pre($obj)
    {
        ?>
        <pre>
                <? print_r($obj); ?>
            </pre>
        <?php
    }
}

new Api();
