<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 19:19
 */

namespace EasySwoole\Pay\AliPay\RequestBean;


use EasySwoole\Spl\SplBean;


class Base extends SplBean
{
	protected $out_trade_no;
	protected $total_amount;
	protected $subject;
	protected $timeout_express;
    protected $body;
	/**
	 * @return mixed
	 */
	public function getOutTradeNo()
	{
		return $this->out_trade_no;
	}

	/**
	 * @param mixed $out_trade_no
	 */
	public function setOutTradeNo( $out_trade_no ) : void
	{
		$this->out_trade_no = $out_trade_no;
	}

	/**
	 * @return mixed
	 */
	public function getTotalAmount()
	{
		return $this->total_amount;
	}

	/**
	 * @param mixed $total_amount
	 */
	public function setTotalAmount( $total_amount ) : void
	{
		$this->total_amount = $total_amount;
	}

	/**
	 * @return mixed
	 */
	public function getSubject()
	{
		return $this->subject;
	}

	/**
	 * @param mixed $subject
	 */
	public function setSubject( $subject ) : void
	{
		$this->subject = $subject;
	}

	/**
	 * @return mixed
	 */
	public function getTimeoutExpress()
	{
		return $this->timeout_express;
	}

	/**
	 * @param mixed $timeout_express
	 */
	public function setTimeoutExpress( $timeout_express ) : void
	{
		$this->timeout_express = $timeout_express;
	}

    public function toArray(array $columns = null, $filter = null): array
    {
        return parent::toArray(null, self::FILTER_NOT_NULL);
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body): void
    {
        $this->body = $body;
    }
}