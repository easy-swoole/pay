<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 19:19
 */

namespace EasySwoole\Pay\AliPay\RequestBean;

/**
 * Class Web
 * @package EasySwoole\Pay\AliPay\RequestBean
 * @method getProductCode()
 * @method getMethod()
 */
class Web extends Base
{
    protected $product_code = 'FAST_INSTANT_TRADE_PAY';
    protected $method = 'alipay.trade.app.pay';

	protected function buildPayHtml($endpoint, $payload): Response
	{
		$sHtml = "<form id='alipaysubmit' name='alipaysubmit' action='".$endpoint."' method='POST'>";
		foreach ($payload as $key => $val) {
			$val = str_replace("'", '&apos;', $val);
			$sHtml .= "<input type='hidden' name='".$key."' value='".$val."'/>";
		}
		$sHtml .= "<input type='submit' value='ok' style='display:none;'></form>";
		$sHtml .= "<script>document.forms['alipaysubmit'].submit();</script>";

		return Response::create($sHtml);
	}

	public function getPayload(){
		$payload = $this->toArray(null,self::FILTER_NOT_NULL);
		$payload = json_decode($payload,JSON_UNESCAPED_UNICODE);
		$payload['method'] = $this->getMethod();
		$payload['biz_content'] = json_encode(array_merge(
			json_decode($payload['biz_content'], true),
			['product_code' => $this->getProductCode()]
		));
		$payload['sign'] = $this->generateSign($payload);
	}
}