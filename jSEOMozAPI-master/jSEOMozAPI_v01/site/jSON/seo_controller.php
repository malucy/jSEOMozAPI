<?php

class mozAPI {

    /**
     * Class to create and parse mozAPI request
     *
     * @package
     * @subpackage	Application
     * @since		1.5
     */
    public $ini_array;
    public $html;
    
    public function getMozData($inURL) {
        // you can obtain you access id and secret key here: http://www.seomoz.org/api/keys
        $accessID = "member-7fa6870997";
        $secretKey = "1badb415495117bf1c759f71cea50874";

// Set your expires for five minutes into the future.
        $expires = time() + 300;

// A new linefeed is necessary between your AccessID and Expires.
        $stringToSign = $accessID . "\n" . $expires;

// Get the "raw" or binary output of the hmac hash.
        $binarySignature = hash_hmac('sha1', $stringToSign, $secretKey, true);

// We need to base64-encode it and then url-encode that.
        $urlSafeSignature = urlencode(base64_encode($binarySignature));

// This is the URL that we want link metrics for.
        $objectURL = $inURL;

// Add up all the bit flags you want returned.
// Learn more here: http://apiwiki.seomoz.org/categories/api-reference
        $cols = "103079233573";

// Now put your entire request together.
// This example uses the Mozscape URL Metrics API.
        $requestUrl = "http://lsapi.seomoz.com/linkscape/url-metrics/" . urlencode($objectURL) . "?Cols=" . $cols . "&AccessID=" . $accessID . "&Expires=" . $expires . "&Signature=" . $urlSafeSignature;

// We can easily use Curl to send off our request.
        $options = array(
            CURLOPT_RETURNTRANSFER => true
        );

        $ch = curl_init($requestUrl);
        curl_setopt_array($ch, $options);
        $content = curl_exec($ch);
        curl_close($ch);
        $array = json_decode($content, true);
        if(empty($array)) {
            //$this->html = $this->html."<br/>Domain ".$inURL." is empty.<br/>";
        } else {
            //$this->html = $this->html.print_r($array)."<br/>"; 
        }
        return $array;
    }
    
    public function getResultsHeader($inURL1,$inURL2) {
        $this->html="<div id=\"list3\" style=\"display:inline-block;float:left;margin:5px;margin-left:25px;\">
                <br/>
                <h2>" . $inURL1 . " vs " . $inURL2 . "</h2>";
    }
    
    public function getResultsFooter() {
        $this->html=$this->html."</div>";
    }

    public function getMozDatafromArray(array $inArray1, array $inArray2, $inURL1, $inURL2, $inDataPoint, $inDataPointDesc) {
        
        if ($inArray1[$inDataPoint] > $inArray2[$inDataPoint]) {
            $var1 = $inArray1[$inDataPoint];
            $var2 = 100;
            $var3 = $inArray2[$inDataPoint]/$inArray1[$inDataPoint]*100;
        } else {
            $var1 = $inArray1[$inDataPoint];
            $var2 = $inArray1[$inDataPoint]/$inArray2[$inDataPoint]*100;
            $var3 = 100;
        }

        
        $this->html = $this->html."
                   <div class=\"seometer\"><div class=\"seorowheader\">".$inDataPointDesc.":</div>
                   <div class=\"seomain\"><div class=\"seometer1\">".$inURL1." - ".$inArray1[$inDataPoint]."</div>
                        <div class=\"meter1\">
                                <span style=\"width: ".$var2."%\"></span>
                        </div>
                   </div><div style=\"clear:both;\"></div>
                    
                   <div class=\"seomain\"><div class=\"seometer1\">".$inURL2." - ".$inArray2[$inDataPoint]."</div>
                        <div class=\"meter2\">
                                <span style=\"width: ".$var3."%\"></span>
                        </div><div style=\"clear:both;\"></div>
                   </div>
                   
                   </div>
                   
                   <br/>";
        return true;
    }
    
    public function getHTMLBody() {
        $html = 
        "<header id=\"heading\">
            <div class=\"wrapper\">
                <h1>3V - SEO Website Analysis</h1>
            </div>
        </header>";

        return $html;
    }
}

?>