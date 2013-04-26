<?php
    include 'seo_controller.php';
    $mozVar1 = new mozAPI();
    $URL1 = $_REQUEST['domain'];
    $URL2 = $_REQUEST['domain_competitor'];
    $htmlbody = $mozVar1->getHTMLBody();
    echo $htmlbody;
    $mozArray1 = $mozVar1->getMozData($URL1);
    $mozArray2 = $mozVar1->getMozData($URL2);
    $mozVar1->getResultsHeader($URL1, $URL2);
    $success = $mozVar1->getMozDatafromArray($mozArray1,$mozArray2,$URL1,$URL2,"uid","External Links");
    $success = $mozVar1->getMozDatafromArray($mozArray1,$mozArray2,$URL1,$URL2,"ueid","Juice Passing External Links");
    $success = $mozVar1->getMozDatafromArray($mozArray1,$mozArray2,$URL1,$URL2,"umrp","mozRank");
    $success = $mozVar1->getMozDatafromArray($mozArray1,$mozArray2,$URL1,$URL2,"upa","Page Authority");
    $success = $mozVar1->getMozDatafromArray($mozArray1,$mozArray2,$URL1,$URL2,"pda","Domain Authority");
    $mozVar1->getResultsFooter();
    echo $mozVar1->html;
?>