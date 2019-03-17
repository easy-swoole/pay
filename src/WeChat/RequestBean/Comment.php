<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/13
 * Time: 14:24
 */

namespace EasySwoole\Pay\WeChat\RequestBean;


class Comment extends Base
{
    protected $sign_type = 'HMAC-SHA256';
    protected $begin_time;
    protected $end_time;
    protected $offset;
    protected $limit;

    public function setBeginTime(string $beginTime): void
    {
        $this->begin_time = $beginTime;
    }

    public function getBeginTime(): string
    {
        return $this->begin_time;
    }

    public function setEndTime(string $endTime): void
    {
        $this->end_time = $endTime;
    }

    public function getEndTime(): string
    {
        return $this->end_time;
    }

    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }
}