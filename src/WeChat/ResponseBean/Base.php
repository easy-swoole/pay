<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 19:19
 */

namespace EasySwoole\Pay\WeChat\ResponseBean;


use EasySwoole\Spl\SplBean;


class Base extends SplBean
{
	protected $appid;
	protected $mch_id;
	protected $nonce_str;
	protected $sign;
	protected $sign_type;
	//    protected $cash_fee;
	//    protected $transaction_id;//退款
	//    protected $out_trade_no;
	//    protected $refund_id;
	//    protected $refund_channel;

	public function toArray(array $columns = null, $filter = null): array
	{
		return parent::toArray($columns, self::FILTER_NOT_NULL);
	}
}