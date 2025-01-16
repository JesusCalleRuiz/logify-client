<?php

namespace JesusCalle\LogifyClient;

use GuzzleHttp\Client;

class Logify
{
    public static function debug($message, $module=null){
        self::record($message, 'app', 'dbg', null, $module);
    }
    public static function info($message, $module=null){
        self::record($message, 'app', 'inf', null, $module);
    }
    public static function notice($message, $module=null){
        self::record($message, 'app', 'not', null, $module);
    }
    public static function warning($message, $module=null){
        self::record($message, 'app', 'wrn', null, $module);
    }
    public static function error($message, $module=null){
        self::record($message, 'app', 'err', null, $module);
    }
    public static function critical($message, $module=null){
        self::record($message, 'app', 'cri', null, $module);
    }
    public static function alert($message, $module=null){
        self::record($message, 'app', 'ale', null, $module);
    }
    public static function record($message, $entryType=null, $severityType=null, $code=null, $module=null, $file=null, $line=null, $position=null){
        if(env('LOGIFY_ACTIVE') != true){
            return;
        }
        $token = env('LOGIFY_TOKEN');
        if($token == null){
            die("Logify token entry LOGIFY_TOKEN is missing");
        }
        $server = env('LOGIFY_SERVER');
        if($server == null){
            die("Logify server entry LOGIFY_SERVER is missing");
        }
        $version = env('LOGIFY_VERSION', 'v1');
        $payload = self::makePayload($entryType, $severityType, $code, $module, $file, $line, $position, $message, $token);

        $client = new Client();
        try{
            $httpResponse = $client->post($server."/api/$version/log", ['json'=>$payload]);
            $body = $httpResponse->getBody();
        }catch(GuzzleHttp\Exception\ClientException $e){
            self::critical("Error interno de cliente Logify. ".$e->getMessage());
        }
        return $body;
    }
    private static function makePayload($entryType, $severityType, $code, $module, $file, $line, $position, $message, $token){
        if($entryType == null){
            $entryType = 'app';
        }
        if($severityType == null){
            $severityType = 'err';
        }
        $payload = (object) [
            'entry_type' => $entryType,
            'severity_type' => $severityType,
            'code' => $code,
            'module' => $module,
            'file' => $file,
            'line' => $line,
            'position' => $position,
            'message' => $message,
            'token' => $token
        ];
        return $payload;
    }
}
