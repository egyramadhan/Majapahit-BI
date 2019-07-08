<?php

namespace App\Libraries;

class TransactionService 
{
    private static $url = 'http://system.makananjajananpait.id/api/';

    public static function methodlogin($username, $password) {
        $url = self::$url . 'method/login?usr=' . $username . '&pwd=' . $password;
        
        /* $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL,            $url);
        curl_setopt( $ch,CURLOPT_POST,           false );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        $result = curl_exec($ch);

        $json = json_decode($result, true);
        return $json; */
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, array('usr'=>$username,'pwd'=>$password));
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'POST');
        // common description bellow
        curl_setopt($ch,CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch,CURLOPT_COOKIEJAR, '(cookie cracker yummy)');
        curl_setopt($ch,CURLOPT_COOKIEFILE, '(cookie cracker yummy)');
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch,CURLOPT_TIMEOUT, (120));
        $response = curl_exec($ch);
        $header = curl_getinfo($ch);
        // 200? 404? or something?
        $error_no = curl_errno($ch);
        $error = curl_error($ch);
        curl_close($ch);
        if($error_no!=200){
        // do something for login error
        // return or exit
        }
        
        $body = json_decode($response, true);
        if(JSON_ERROR_NONE == json_last_error()){
        // $response is not valid (as JSON)
        // do something for login error
        // return or exit
        }
        return [
            'error' => false,
            'message' => $body,
        ];
        // use $body
    }
    public static function login($username, $password) {
        $url = self::$url . 'method/login?usr=' . $username . '&pwd=' . $password;
        
        /* $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL,            $url);
        curl_setopt( $ch,CURLOPT_POST,           false );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        $result = curl_exec($ch);

        $json = json_decode($result, true);
        return $json; */
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, array('usr'=>$username,'pwd'=>$password));
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'POST');
        // common description bellow
        curl_setopt($ch,CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch,CURLOPT_COOKIEJAR, '(cookie cracker yummy)');
        curl_setopt($ch,CURLOPT_COOKIEFILE, '(cookie cracker yummy)');
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch,CURLOPT_TIMEOUT, (120));
        $response = curl_exec($ch);
        $header = curl_getinfo($ch);
        // 200? 404? or something?
        $error_no = curl_errno($ch);
        $error = curl_error($ch);
        curl_close($ch);
        if($error_no!=200){
        // do something for login error
        // return or exit
        }
        $body = json_decode($response, true);
        if(JSON_ERROR_NONE == json_last_error()){
        // $response is not valid (as JSON)
        // do something for login error
        // return or exit
        }
        return $response;
        // use $body
    }

    public static function getProducts($username, $password) {
        //static::login($username, $password);
        static::login($username, $password);
        $filters = json_encode(array(
            'fields'=>'["item_name","item_code","name","standard_rate","stock_uom","thumbnail","item_group"]',
            // 'fields'=>'["item_name"]',
            'filters'=>'[["Item","item_group","=","Products"]]'
        ));

        // dd($filters);

        $dataFields = json_encode(["item_name","item_code","name","standard_rate","stock_uom","thumbnail","item_group","kategori_menu"]);
        // $dataFields = json_encode(["item_name"]);
        $dataFilters = json_encode([["Item","item_group","=","Products"]]);

        $url = self::$url . 'resource/Item?';
        // dd($url);
        // check if $filters invalid
        $dataFields = array('fields'=>$dataFields);
        $dataFilters = array('filters'=>$dataFilters);
        $dataLimits = array('limit_page_length'=>'9999999');
        $q = http_build_query($dataFields);
        $q .= '&' . http_build_query($dataFilters);
        $q .= '&' . http_build_query($dataLimits);
        // dd($q);
        // return $q;
        $ch = curl_init($url . $q);
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch,CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch,CURLOPT_COOKIEJAR, '(cookie cracker yummy)');
        curl_setopt($ch,CURLOPT_COOKIEFILE, '(cookie cracker yummy)');
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch,CURLOPT_TIMEOUT, (120));
        $response = curl_exec($ch);
        $header = curl_getinfo($ch);

        // dd($response);

        // 200? 404? or something?
        $error_no = curl_errno($ch);
        $error = curl_error($ch);
        curl_close($ch);
            
        $body = json_decode($response, true);

         // dd($body);
        // return ['data' => $response];
        return $body;
    }

    public static function getProductCategories($username, $password) {
        //static::login($username, $password);
        static::login($username, $password);

        $url = self::$url . 'resource/Kategori Menu';
        
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch,CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch,CURLOPT_COOKIEJAR, '(cookie cracker yummy)');
        curl_setopt($ch,CURLOPT_COOKIEFILE, '(cookie cracker yummy)');
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch,CURLOPT_TIMEOUT, (120));
        $response = curl_exec($ch);
        $header = curl_getinfo($ch);
        // 200? 404? or something?
        $error_no = curl_errno($ch);
        $error = curl_error($ch);
        curl_close($ch);
            
        $body = json_decode($response, true);

        // dd($body);
        return $body;
    }

    public static function uploadProduct($username, $password, $body) {
        static::login($username, $password);

        $url = self::$url . 'resource/Sales Invoice/';

        $headers = array(
            'Content-Type: application/json'
        );
        
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch,CURLOPT_HTTPHEADER,     $headers );
        curl_setopt($ch,CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch,CURLOPT_COOKIEJAR, '(cookie cracker yummy)');
        curl_setopt($ch,CURLOPT_COOKIEFILE, '(cookie cracker yummy)');
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode($body));
        curl_setopt($ch,CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch,CURLOPT_TIMEOUT, (120));
        $response = curl_exec($ch);
        $header = curl_getinfo($ch);
        
        $error_no = curl_errno($ch);
        $error = curl_error($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if($httpcode!=200){
            if ($httpcode != 417) {
                return [
                    'error' => true,
                    'message' => $response,
                    'code' => $error_no,
                    'status_code' => $httpcode,
                ];
            }
        }
        $body = json_decode($response, true);

        curl_close($ch);
            
        $body = json_decode($response, true);

        return [
            'error' => false,
            'message' => $body,
        ];
    }

    public static function remote($data)
	{
        $url = 'https://fcm.googleapis.com/fcm/send';

        $body = array(
            'registration_ids' => $data['token']
        );

        if (strtolower($data['device']) == 'android') {
            $body['data']         = $data;
        }else{
            $body['data']         = $data;
            $body['notification'] = $data;
        }

        $headers = array(
            'Authorization: key=' . env('FCM_KEY'),
            'Content-Type: '      . env('FCM_CONTENT_TYPE'),
            'Sender: id='         . env('FCM_ID')
        );
        
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL,            $url);
        curl_setopt( $ch,CURLOPT_POST,           true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER,     $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS,     json_encode( $body ) );
        $result = curl_exec($ch );

        return $result;		
    }
    public static function getInvoice($username, $password) {
        static::login($username, $password);
        $filters = json_encode(array(
            'fields'=>'["name","booking_name","net_total","status","net_total","base_grand_total","posting_date"]',
        ));
        $dataFields = json_encode(["customer","item_name","item_code","name","standard_rate","stock_uom","thumbnail","item_group","kategori_menu"]);
        $url = self::$url . 'resource/Sales%20Invoice?fields=["customer","name","booking_name","net_total","status","net_total","base_grand_total","posting_date"]&limit_page_length=9999999999999999';
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch,CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch,CURLOPT_COOKIEJAR, '(cookie cracker yummy)');
        curl_setopt($ch,CURLOPT_COOKIEFILE, '(cookie cracker yummy)');
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch,CURLOPT_TIMEOUT, (120));
        $response = curl_exec($ch);
        $header = curl_getinfo($ch);
        // 200? 404? or something?
        $error_no = curl_errno($ch);
        $error = curl_error($ch);
        curl_close($ch);
        $body = json_decode($response, true);
        // return ['data' => $response];
        return $body;
    }
    public static function getInvoiceItem($username, $password, $name) {
        static::login($username, $password);
        $dataFields = json_encode(["item_group","amount","qty","rate","stock_uom","item_name","uom","description"]);
        // $dataFields = json_encode(["item_name"]);
        // $dataFilters = json_encode([["Item","item_group","=","Products"]]);

        $url = self::$url . 'resource/Sales%20Invoice/'.$name.'?fields=["item_group","amount","qty","rate","stock_uom","item_name","uom","description"]&limit_page_length=9999999999999999';
        // dd($url);
        // check if $filters invalid
        // $dataFields = array('fields'=>$dataFields);
        // $dataFilters = array('filters'=>$dataFilters);
        // $dataLimits = array('limit_page_length'=>'9999999');
        // $q = http_build_query($dataFields);
        // $q .= '&' . http_build_query($dataFilters);
        // $q .= '&' . http_build_query($dataLimits);
        // dd($q);
        // return $q;
        // dd($url.$q);
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch,CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch,CURLOPT_COOKIEJAR, '(cookie cracker yummy)');
        curl_setopt($ch,CURLOPT_COOKIEFILE, '(cookie cracker yummy)');
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch,CURLOPT_TIMEOUT, (120));
        $response = curl_exec($ch);
        $header = curl_getinfo($ch);

        // dd($response);

        // 200? 404? or something?
        $error_no = curl_errno($ch);
        $error = curl_error($ch);
        curl_close($ch);
            
        $body = json_decode($response, true);

         // dd($body);
        // return ['data' => $response];
        return $body;
    }
}
