<?php

namespace Utils\Components\Oauth;

use Utils\Components\Http;

/**
 * 第三方组件: 微信公众号
 * @package Utils\Components\Oauth
 */
trait WeChatPub
{
    /**
     * 获取公众号用户OPENID
     * @param  string  $code
     * @param  string  $appId
     * @param  string  $appSecret
     * @return int|mixed|string
     */
    public static function getOpenIdByWeChatPub(string $code, string $appId, string $appSecret)
    {
        $uri = 'https://api.weixin.qq.com/sns/oauth2/access_token';
        $uri .= "?appid={$appId}&secret={$appSecret}&code={$code}&grant_type=authorization_code";
        $resp = Http::Get($uri);
        $resp = json_decode($resp, true);
        if (isset($resp['errcode'])) {
            return $resp;
        }
        return $resp;
    }

    /**
     * 获取公众号用户信息
     * @param  string  $accessToken
     * @param  string  $openId
     * @param  string  $lang
     * @return mixed|string
     */
    public static function getUserInfoByWeChatPub(string $accessToken, string $openId, string $lang = 'Zh-Cn')
    {
        $uri = 'https://api.weixin.qq.com/sns/userinfo';
        $uri .= "?access_token={$accessToken}&openid={$openId}&lang=".$lang;
        $resp = Http::Get($uri);
        $resp = json_decode($resp, true);
        if (isset($resp['errcode'])) {
            return $resp;
        }
        return $resp;
    }

    /**
     * 通过CODE获取微信公众号用户信息
     * @param  string  $code
     * @param  string  $appId
     * @param  string  $appSecret
     * @param  string  $lang
     * @return int|mixed|string
     */
    public static function getWeChatPubUserInfoByCode(
        string $code,
        string $appId,
        string $appSecret,
        string $lang = 'Zh-CN'
    ) {
        $resp = self::getOpenIdByWeChatPub($code, $appId, $appSecret);
        if (isset($resp['errcode'])) {
            return $resp;
        }
        $resp = self::getUserInfoByWeChatPub($resp['access_token'], $resp['openid'], $lang);
        if (isset($resp['errcode'])) {
            return $resp;
        }
        return $resp;
    }
}