<?php
    function getNavData($endpoint){
        $url = config('app.odata').$endpoint;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, config('app.credentials'));
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_NTLM);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Connection: Keep-Alive',
            'Accept: application/json',
            'Content-Type: application/json; charset=utf-8',
            "Accept: */*"
        ]);
        $response = curl_exec($ch);
        $check = json_decode($response, true);
        return $check;
    }

    function getfilteredNavData($endpoint, $filtersubject, $filterfield){
        if(is_numeric($filterfield)){
            $url = config('app.odata').$endpoint.'?'.'$'."filter=".rawurlencode($filtersubject." eq ".$filterfield."");
        }else{
            $url = config('app.odata').$endpoint.'?'.'$'."filter=".rawurlencode($filtersubject." eq '".$filterfield."'");
        }
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, config('app.credentials'));
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_NTLM);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Connection: Keep-Alive',
            'Accept: application/json',
            'Content-Type: application/json; charset=utf-8',
            "Accept: */*"
        ]);
        $response = curl_exec($ch);
        $check = json_decode($response, true);
        return $check;
    }

    function vegetfilteredNavData($endpoint, $filtersubject, $filterfield){
        $url = config('app.odata').$endpoint.'?'.'$'."filter=".rawurlencode($filtersubject." ne '".$filterfield."'");
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, config('app.credentials'));
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_NTLM);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Connection: Keep-Alive',
            'Accept: application/json',
            'Content-Type: application/json; charset=utf-8',
            "Accept: */*"
        ]);
        $response = curl_exec($ch);
        $check = json_decode($response, true);
        return $check;
    }

    function filterData($webServiceName,$filter){
        $url = config('app.odata').$webServiceName.'?'.'$'."filter=".rawurlencode($filter);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, config('app.credentials'));
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_NTLM);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Connection: Keep-Alive',
            'Accept: application/json',
            'Content-Type: application/json; charset=utf-8',
            "Accept: */*"
        ]);
        $response = curl_exec($ch);
        $check = json_decode($response, true);
        return $check;
    }

?>