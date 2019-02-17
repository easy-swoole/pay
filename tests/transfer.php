<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-17
 * Time: 20:46
 */
require_once '../vendor/autoload.php';
go(function (){
    $aliConfig = new \EasySwoole\Pay\AliPay\Config();
    $aliConfig->setGateWay(\EasySwoole\Pay\AliPay\GateWay::SANDBOX);
    $aliConfig->setAppId('2016091800538339');
    $aliConfig->setPublicKey('MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAhnPaUjgiMnLHSVfzcbt/nMDAzQY7YNLgGZOQEDB4VqwL6Z3OiPCh/UVsP/82YF7FS4bb4lOzdI5doiY6vFdYB+Tv3ds1xA8+yMQaQWYVxlcKOjlZtdqDsEZywxRqgNsM9IJOKFzvnFhp16MdNCzluqTqPB3vxNVWlZPM4yyT8GS97LoGp9DmoBgYJUIEYlr+AZ65sGt0KtuX9Ap31+iwxEwvn8fnVCghHauVe5TJqPIZE5Ah9lGMf81q/B3mK4yPp2w/lG9AZQkQ2Qox5R+bshwW61NrZnUg0iUViMrdRw9BUY458FUV0op0DneDZ2NZ+9t25DDfZTF7rPPv6uCejwIDAQAB');
    $aliConfig->setPrivateKey('MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCGc9pSOCIycsdJV/Nxu3+cwMDNBjtg0uAZk5AQMHhWrAvpnc6I8KH9RWw//zZgXsVLhtviU7N0jl2iJjq8V1gH5O/d2zXEDz7IxBpBZhXGVwo6OVm12oOwRnLDFGqA2wz0gk4oXO+cWGnXox00LOW6pOo8He/E1VaVk8zjLJPwZL3sugan0OagGBglQgRiWv4Bnrmwa3Qq25f0CnfX6LDETC+fx+dUKCEdq5V7lMmo8hkTkCH2UYx/zWr8HeYrjI+nbD+Ub0BlCRDZCjHlH5uyHBbrU2tmdSDSJRWIyt1HD0FRjjnwVRXSinQOd4NnY1n723bkMN9lMXus8+/q4J6PAgMBAAECggEAYv/rQZ8TjxH0q4yXNKdaz5EeZdiw4Bpl6G8/JKyL70W/f8UyzqJgpJz5mCXTZCJkI7ipL31yJeCuETcVCJlHuIhaFoHSlQqksC+1JXKFlgWBAl44MC81yBYXao0d3sNsRp2r7wx/Yh+3z4/LcR+eCFBmKN3iLozntDugIaYxSE/T7jMSQrsfe0rhMgapUuP5qGdBsa3F5VBDiL1g+B+3/x5shOHOHE8A1GIJwkcWeeA40Sh5U0o/DUbDgXAzhVVI8+YHXudrJ7hdRbxwW3rHZtEivjVxbBoNu+YBfX4wAn80tMIkLZ74paewndrn7kTUtkPcpw3MQ2ldZefMOJlwAQKBgQDDsMbSnaTbPzgnJrkHFTDREGX4SOI1ZZ8hLc4sg9x7bFip2LRcn8tc3D7Ym7jRGYg2h3xwEUECgzZAafBRnawEnLsah5z9FNEUJTIksn8yC+A95Xfs8P0tt/njnYh8qR1D9pyUdUCpGaomPbBz3FM4PuJNKQwgzoQ9hL5gQPlvnwKBgQCv46MS0hRvlqJWMDvF0t23ZtyFhCTKjW/azQVo7CZvk+2E6UrIgfVlrjn9MOpwaBQObFMhR9jCj+mUzE025skKUGJmjUCN7ZGYNsNkqu2jh4vsoj+9bp4CQ6fQSaX0pSoOvBiPKI8g++4bMn+69BPZyRDUSH/Nxpq8CfbSt5+rEQKBgCCzwgYgYhRhlDi2t+T/HZFSdDfxthvGR7l7tiCqSIY3rPl1RW7VJV73T2lTXKdU5PZ33cu8lmidFMve6FI7TyvWJU5hq1J/0BDVxnNrgOYUJf0yA8CM5UJmpFPtV4m9mS5qX/BPR+b6avzJAlvaTe3wVFEgsu4olODS9h2Pvh9xAoGBAK52z1RlyRt+gPuY0FFC/eVjRC2zi4LWlDKl1k3in6VhR+HkPedw8Oaw0JhSItjog6xiynpid6FVek278IManCN85H3wci3Vjes7tshtu1XPp31K2oqd5GE+loBF7TUjdvoynPGzO3VuLxoPFx9r5xzJEcZfO1XzP5xxDcCpntjhAoGAeZhpPyM7aHYL6PfbLlSZ9479k5hIETU4WBIEjwY30ASxeJ0fpjACw9IVOlCMjGUIAF1Mz+AO6cumO188lhhxRtvpO0FyQzVeEKGJpoIXowneQEFqMhHeMCCMzXbE2xDD/xfuBDZCoXkCUWRLt40YjKUpE4JDo+ulDGM8HIeVNNE=');
    $pay = new \EasySwoole\Pay\Pay();
    $order = new \EasySwoole\Pay\AliPay\RequestBean\Transfer();
    $order->setSubject('测试');
    $order->setTotalAmount('0.01');
	$order->setPayeeType('ALIPAY_LOGONID');
	$order->setPayeeAccount('hcihsn8174@sandbox.com');
    $aliPay = $pay->aliPay($aliConfig);
    $data = $aliPay->transfer($order)->toArray();
	$aliPay->preQuest($data);
    var_dump($data);
});

