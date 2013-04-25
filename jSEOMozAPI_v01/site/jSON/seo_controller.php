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
    
    public function getMozIni() {
        $this->$ini_array = parse_ini_file("mozAPI.ini");
    }
    
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
    
    public function getSEOHTMLHeader() {

        $html = 
        "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=8\" />
	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
	<title>3V Business Solutions Free Website Analysis | Free SEO Analysis | Detroit SEO Company Analysis</title>
	<meta name=\"description\" content=\"Test your site for Google Yahoo, and Bing optimization. How do you compare with your online competition? Find out with a free website analysis.\" />
	<meta name=\"keywords\" content=\"\" />
	
	<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js\"></script>
        <script type=\"text/javascript\" src=\"./js/jquery.fancybox-1.3.4.pack.js\"></script>
        <link rel=\"Stylesheet\" href=\"./css/jquery.fancybox-1.3.4.css\" />
                
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
        <link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"./css/template.css\">
	<link href=\"./css/base.css\" rel=\"stylesheet\" type=\"text/css\" />
	<link href=\"./css/boostability.fonts.css\" rel=\"stylesheet\" type=\"text/css\" />
	<link href=\"./css/layout.css\" rel=\"stylesheet\" type=\"text/css\" />
	<link href=\"./css/custom.css\" rel=\"Stylesheet\" type=\"text/css\" />

        <script type=\"text/javascript\">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-29180909-1']);
            _gaq.push(['_setDomainName', '3vbizsolutions.com']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();

        </script>";

        return $html;
    }

    public function getHTMLHeader() {

        $html = "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"><title>3V - SEO Website Analysis</title>
        <meta name=\"author\" content=\"Michael Lucy\">
        <link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"./css/styles.css\">
        <link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"./css/animate.css\">
        <link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"./css/home.css\">
        <link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"./css/template.css\">
        <script type=\"text/javascript\" src=\"./js/Scripts/menu.js\"></script>
	<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js\"></script>
	<script type=\"text/javascript\" src=\"./js/Scripts/jquery.cycle.all.js\"></script>
	<script type=\"text/javascript\" src=\"./js/Scripts/main.js\"></script>

        <script type=\"text/javascript\">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-29180909-1']);
            _gaq.push(['_setDomainName', '3vbizsolutions.com']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();

        </script>";

        return $html;
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

    public function getHTMLFooter() {
        $html = "<footer id=\"extra\"></footer>
                 <script type=\"text/javascript\">
                    $(document).ready(function(){
                    $('form').submit(function(e){
                        e.preventDefault();
                        var timer;
    
                        $('#name').addClass('shakenform wrongdata');
    
                        clearTimeout(timer);
                        timer = setTimeout(function() { $('#name').removeClass('shakenform') }, 800);
                    });
  
                $('#error a').on('click', function(e){
                    e.preventDefault();
    
                    var timer;
                    var animateStyle = $(this).attr('data-anim');
    
                    $('#error').addClass(animateStyle);
    
                    // reset timer and after 800ms remove the error div
                    clearTimeout(timer);
                    timer = setTimeout(function() { $('#error').remove(); }, 800);  
                });
            });
        </script>

    </body>";

        return $html;
    }

}

?>