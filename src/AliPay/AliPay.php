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
use EasySwoole\Pay\Utility\NewWork;
class AliPay
{
	/**
	 * Const mode_normal.
	 */
	const MODE_NORMAL = 'normal';

	/**
	 * Const mode_dev.
	 */
	const MODE_DEV = 'dev';

	/**
	 * Const url.
	 */
	const URL = [
		self::MODE_NORMAL => 'https://openapi.alipay.com/gateway.do',
		self::MODE_DEV    => 'https://openapi.alipaydev.com/gateway.do',
	];

	/**
	 * Alipay gateway.
	 *
	 * @var string
	 */
	protected $baseUri;


    private $config;

    function __construct(Config $config)
    {
	    $this->baseUri = Alipay::URL[isset($config['mode']) ?? self::MODE_NORMAL];
	    $this->config = $config;
    }
	/**
	 * Get Base Uri.
	 *
	 * @return string
	 */
	public function getBaseUri()
	{
		return $this->baseUri;
	}



    /*
     * 电脑支付
     */
    public function web(Web $web):WebResponse
    {
        return new WebResponse($web->getPayload());
    }
    /*
     * 手机网站支付
     */
    public function wap(Wap $wap):WapResponse
    {
	    return new WapResponse($wap->getPayload());
    }

    /*
     * APP 支付
     */
    public function app(App $app):AppResponse
    {


		$data = $app->getPayload();
	    $result = mb_convert_encoding(NewWork::post($this->getBaseUri(),$data), 'utf-8', 'gb2312');
	    $result = json_decode($result, true);

	    $method = str_replace('.', '_', $data['method']).'_response';

	    if (!isset($result['sign']) || $result[$method]['code'] != '10000') {
		    throw new GatewayException(
			    'Get Alipay API Error:'.$result[$method]['msg'].($result[$method]['sub_code'] ?? ''),
			    $result,
			    $result[$method]['code']
		    );
	    }

	    if ($this->verifySign($result[$method], true, $result['sign'])) {
		    return new AppResponse($result[$method]);
	    }


	    throw new InvalidSignException('Alipay Sign Verify FAILED', $result);


    }
    /*
     * 刷卡支付
     */
    public function pos(Pos $pos):PosResponse
    {
	    unset($payload['trade_type'], $payload['notify_url']);

	    $payload['sign'] = $this->generateSign($payload);


	    return $this->requestApi('pay/micropay', $payload);
    }

    /*
     * 扫码支付
     */
    public function scan(Scan $scan):ScanResponse
    {
	    $payload['spbill_create_ip'] = Request::createFromGlobals()->server->get('SERVER_ADDR');
	    $payload['trade_type'] = $this->getTradeType();
	    return $this->preOrder($payload);
    }

    /*
     * 帐户转账
     */
    public function transfer(Transfer $transfer):TransferResponse
    {
	    $payload['method'] = $this->getMethod();
	    $payload['biz_content'] = json_encode(array_merge(
		    json_decode($payload['biz_content'], true),
		    ['product_code' => $this->getProductCode()]
	    ));
	    $payload['sign'] = $this->generateSign($payload);


	    return $this->requestApi($payload);
    }

    /*
     * 小程序支付
     */
    public function miniProgram(MiniProgram $miniProgram):MiniProgramResponse
    {
	    if (empty(json_decode($payload['biz_content'], true)['buyer_id'])) {
		    throw new \Yansongda\Pay\Exceptions\InvalidArgumentException('buyer_id required');
	    }

	    $payload['method'] = $this->getMethod();
	    $payload['sign'] = $this->generateSign($payload);


	    return $this->requestApi($payload);
    }

    public function verify(NotifyRequest $request):bool
    {

    }


}