<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 11:42
 */

namespace EasySwoole\Pay\AliPay;


use EasySwoole\Pay\AliPay\RequestBean\App;
use EasySwoole\Pay\AliPay\RequestBean\MiniProgram;
use EasySwoole\Pay\AliPay\RequestBean\NotifyRequest;
use EasySwoole\Pay\AliPay\RequestBean\Pos;
use EasySwoole\Pay\AliPay\RequestBean\Scan;
use EasySwoole\Pay\AliPay\RequestBean\Transfer;
use EasySwoole\Pay\AliPay\RequestBean\Wap;
use EasySwoole\Pay\AliPay\RequestBean\Web;
use EasySwoole\Pay\AliPay\ResponseBean\Web as WebResponse;
use EasySwoole\Pay\AliPay\ResponseBean\Wap as WapResponse;
use EasySwoole\Pay\AliPay\ResponseBean\App as AppResponse;
use EasySwoole\Pay\AliPay\ResponseBean\Pos as PosResponse;
use EasySwoole\Pay\AliPay\ResponseBean\Scan as ScanResponse;
use EasySwoole\Pay\AliPay\ResponseBean\Transfer as TransferResponse;
use EasySwoole\Pay\AliPay\ResponseBean\MiniProgram as MiniProgramResponse;

class AliPay
{
    private $config;

    function __construct(Config $config)
    {
        $this->config = $config;
    }

    /*
     * 电脑支付
     */
    public function web(Web $web):WebResponse
    {
        $content = $web->toArray(null,$web::FILTER_NOT_NULL);
        $content = json_decode($content,JSON_UNESCAPED_UNICODE);
        return new WebResponse();
    }
    /*
     * 手机网站支付
     */
    public function wap(Wap $wap):WapResponse
    {

    }

    /*
     * APP 支付
     */
    public function app(App $app):AppResponse
    {

    }
    /*
     * 刷卡支付
     */
    public function pos(Pos $pos):PosResponse
    {

    }

    /*
     * 扫码支付
     */
    public function scan(Scan $scan):ScanResponse
    {

    }

    /*
     * 帐户转账
     */
    public function transfer(Transfer $transfer):TransferResponse
    {

    }

    /*
     * 小程序支付
     */
    public function miniProgram(MiniProgram $miniProgram):MiniProgramResponse
    {

    }

    public function verify(NotifyRequest $request):bool
    {

    }

    private function generateSign(array $data):string
    {

    }
}