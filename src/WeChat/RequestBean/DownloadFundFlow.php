<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/13
 * Time: 13:49
 */

namespace EasySwoole\Pay\WeChat\RequestBean;


class DownloadFundFlow extends Base
{
    protected $sign_type = 'HMAC-SHA256';
    protected $bill_date;
    protected $account_type;
    protected $tar_type;

    public function setBillDate(string $billDate): void
    {
        $this->bill_date = $billDate;
    }

    public function getBillDate(): string
    {
        return $this->bill_date;
    }

    public function setAccountType(string $accountType): void
    {
        $this->account_type = $accountType;
    }

    public function getAccountType(): string
    {
        return $this->account_type;
    }

    public function setTarType(string $tarType): void
    {
        $this->tar_type = $tarType;
    }

    public function getTarType(): string
    {
        return $this->tar_type;
    }
}