<?php
use Workerman\Worker;
require_once './Workerman/Autoloader.php';

$dnsWorker = new Worker("udp://0.0.0.0:53");

$dnsWorker->count = 4;

$dnsWorker->onMessage = function($connection, $data)
{
    $dataLen = strlen($data);
    $domainLen = $dataLen - 16;
    $hexstr = unpack('H*',$data);
    var_dump($hexstr);
    //$connection->send('hello world');
    $up = unpack("nid/Cqoatr/Crzr/nqdcount/nancount/nnscount/narcount/C{$domainLen}domain/H*",$data);
    var_dump($up);
};

Worker::runAll();
