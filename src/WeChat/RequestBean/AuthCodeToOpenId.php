<?php
/**
 * This file is part of EasySwoole.
 *
 * @link https://www.easyswoole.com
 * @document https://www.easyswoole.com
 * @contact https://www.easyswoole.com/Preface/contact.html
 * @license https://github.com/easy-swoole/easyswoole/blob/3.x/LICENSE
 */

namespace EasySwoole\Pay\WeChat\RequestBean;

class AuthCodeToOpenId extends Base
{
    /**
     * 付款码
     *
     * @var string
     */
    protected $auth_code;

    public function getAuthCode(): string
    {
        return $this->auth_code;
    }

    public function setAuthCode(string $authCode): void
    {
        $this->auth_code = $authCode;
    }
}
