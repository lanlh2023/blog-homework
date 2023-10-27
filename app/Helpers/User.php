<?php
use Illuminate\Support\Facades\Config;

 /**
* Get message from message_file, params is optional
* 
* @param string $key
* @param array $paramArray
* @return mixed|null
*/
if (!function_exists('getMessage')) { 
  function getMessage($key, $paramArray = []) {
        $message = Config::get($key);

        if ($message && is_string($message)) {
            foreach ($paramArray as $param => $value) {
                $message = str_replace(sprintf('<%d>', $param), $value, $message);
            }
        }

        return $message;
    }
}
