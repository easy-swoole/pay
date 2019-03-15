<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/13
 * Time: 11:10
 */

namespace EasySwoole\Pay\WeChat\RequestBean;


class Download extends Base
{
    protected $bill_date;
    protected $bill_type;
    protected $tar_type;

    public function setBillDate(string $billDate): void
    {
        $this->bill_date = $billDate;
    }

    public function getBillDate(): string
    {
        return $this->bill_date;
    }

    public function setBillType(string $billType): void
    {
        $this->bill_type = $billType;
    }

    public function getBillType(): string
    {
        return $this->bill_type;
    }

    public function setTarType(string $tarType):void
    {
        $this->tar_type = $tarType;
    }

    public function getTarType(): string
    {
        return $this->tar_type;
    }
}