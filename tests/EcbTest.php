<?php
namespace Jsq\EncryptionStreams;

class EcbTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldReportCipherMethodOfECB()
    {
        $this->assertSame('ECB', (new Ecb)->getName());
    }

    public function testShouldReturnEmptyStringForCurrentIv()
    {
        $iv = new Ecb();
        $this->assertEmpty($iv->getCurrentIv());
        $iv->update(random_bytes(128));
        $this->assertEmpty($iv->getCurrentIv());
    }

    public function testSeekShouldBeNoOp()
    {
        $iv = new Ecb();
        $baseIv = $iv->getCurrentIv();
        $iv->update(random_bytes(128));
        $this->assertSame($baseIv, $iv->getCurrentIv());
    }

    public function testShouldReportThatPaddingIsRequired()
    {
        $this->assertTrue((new Ecb)->requiresPadding());
    }
}