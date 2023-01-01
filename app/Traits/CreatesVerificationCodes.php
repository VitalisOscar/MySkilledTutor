<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait CreatesVerificationCodes{

    /**
     * Generate a new or get a usable verification code
     *
     * @param $user
     * @param string $codeUsage - The usage if the verification code e.g otp, phone_verification
     * @param int $expiryMinutes - The minutes which a new code is valid. Will be ignored if code was already generated
     *
     * @return string
     */
    function getVerificationCode($user, $codeUsage, $expiryMinutes = 0){
        // Key to store the code in cache with
        $cacheKey = $this->getCodeStorageKey($user, $codeUsage);

        // Check if a code exists
        $code = Cache::get($cacheKey);

        if($code == null){
            // Generate a new one
            $code = "";

            // Codes shall be 6 numbers long
            for($i = 0; $i < 6; $i++){
                $code .= rand(1, 9);
            }

            Cache::put($cacheKey, $code, now()->addMinutes($expiryMinutes));
        }

        return $code;
    }

    /**
     * Check if the code provided matches the previously generated code for the entity
     *
     * @param string $providedCode - The code provided by the user
     * @param $user
     * @param string $codeUsage - The usage of the verification code e.g otp, phone_verification
     *
     * @return bool
     */
    function checkVerificationCode($providedCode, $user, $codeUsage){
        if($providedCode == null){
            return false;
        }

        // Key to use to extract cache value
        $cacheKey = $this->getCodeStorageKey($user, $codeUsage);

        $verificationCode = Cache::get($cacheKey);

        return ($verificationCode == $providedCode);
    }

    /**
     * Will generate a unique key that can be used to store and retrieve the code in cache
     *
     * @param $user
     * @param string $codeUsage - The usage if the verification code e.g otp, verification
     *
     * @return string
     */
    function getCodeStorageKey($user, $codeUsage){
        // e.g otp:customer:122:175.104.34.21
        return $codeUsage."_".$user->id.":".request()->ip();
    }

}

