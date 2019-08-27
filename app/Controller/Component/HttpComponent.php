<?PHP


class HttpService
{
    public static function post($endpoint, $fields = array(), $headers = array(), $custom = null)
    {
        $headers[] = 'Content-Type:application/json';
        $headers[] = 'Accept:application/json';
        $body = (empty($fields)) ? null:json_encode($fields);
        $opts = array(
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_HEADER         => false,
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => $body,
        );
        //caso seja PUT/DELETE
        if($custom)
            $opts[CURLOPT_CUSTOMREQUEST] = $custom;
        $ch = curl_init($endpoint);
        curl_setopt_array($ch, $opts);
        $result             = array();
        $result["body"]     = json_decode(curl_exec($ch), true);
        $result["httpCode"] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $result;
    }

    public static function get($endpoint, $fields = array(), $headers = array())
    {

        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Accept: application/json';
        $headers[] = 'Cache-Control: no-cache';
        $body = (empty($fields)) ? null:http_build_query($fields);
        $opts = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_HEADER         => false,
        );

        $ch = curl_init("{$endpoint}?{$body}");
        curl_setopt_array($ch, $opts);
        $result             = array();
        $result["body"]     = json_decode(curl_exec($ch), true);
        $result["httpCode"] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $result;
    }
}