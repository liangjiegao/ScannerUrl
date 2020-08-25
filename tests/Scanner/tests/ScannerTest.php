<?php


namespace Tests\Scanner\tests;


use Tests\Scanner\src\Scanner;
use Tests\TestCase;
use League\Csv\Reader;

class ScannerTest extends TestCase
{
    public function testGetInvalidUrls(){
        $urls = [
            'http://mail.hichina.com/',
            'http://mail.hichinaaaa.com/'
        ];
        $scanner = new Scanner($urls);
        $invalid = $scanner->getInvalidUrls();

        self::assertSame([
            [
                'url' => 'http://mail.hichinaaaa.com/', 'status' => 500
            ]
        ], $invalid);
    }
}
