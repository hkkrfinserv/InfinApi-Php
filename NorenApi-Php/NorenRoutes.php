<?php

class NorenRoutes {
    private $baseUrl;
    public $routes;

    public function __construct($baseUrl) {
        $this->baseUrl = rtrim($baseUrl, '/'); // Remove trailing slash from the base URL
        $this->routes = [
            'authorize' => '/QuickAuth',
            'logout' => '/Logout',
            'searchscrip' => '/SearchScrip',
            'orderbook' => '/OrderBook',
            'tradebook' => '/TradeBook',
            'placeorder' => '/PlaceOrder',
            'modifyorder' => '/ModifyOrder',
            'cancelorder' => '/CancelOrder',
            'timepriceseries' => '/TPSeries',
            'forgotpassword_OTP' => '/FgtPwdOTP',
            'exitorder' => '/ExitSNOOrder',
            'product_conversion'=> '/ProductConversion',
            'singleorderhistory'=> '/SingleOrdHist',
            'get_limits' => '/Limits',
            'get_positions' => '/PositionBook',
            'GetQuotes'=>'/GetQuotes',
            'GetOptionChain'=>'/GetOptionChain',
            'GetSecurityInfo'=>'/GetSecurityInfo',
            'get_daily_price_series'=> '/EODChartData',
            'Get_Holdings'=> '/Holdings',
            'span_calculator'=> '/SpanCalc',
            'get_option_greek'=> '/GetOptionGreek'
        ];
    }

    public function getFullUrl($route) {
        if (isset($this->routes[$route])) {
            return $this->baseUrl . $this->routes[$route];
        } else {
            return null; // Handle non-existent route
        }
    }
}

// Example Usage:
$baseUrl = 'http://matsya.kambala.co.in:9959/NorenWClient'; // Replace with your main URL
$websocketUrl="ws://matsya.kambala.co.in:9657/NorenWS/";  // Replace with your websocket URL
$norenRoutes = new NorenRoutes($baseUrl);

?>
