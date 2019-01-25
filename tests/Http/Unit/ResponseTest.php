<?php

namespace Textline\Tests\Http\Unit;

use PHPUnit\Framework\TestCase;
use Textline\Http\Response;

class ResponseTest extends TestCase
{
    /** @test */
    public function a_response_has_a_status_code_and_content()
    {
        $code = 200;
        $contentData = [
            'content' => 'here'
        ];
        $content = json_encode($contentData);

        $response = new Response($code, $content);

        $this->assertEquals([
            $code, $contentData
        ], [
            $response->getStatusCode(),
            $response->getContent(),
        ]);
    }

    /** @test */
    public function it_can_confirm_whether_the_response_was_successful()
    {
        $code = 200;
        $contentData = [
            'content' => 'here'
        ];
        $content = json_encode($contentData);

        $response = new Response($code, $content);

        $this->assertTrue($response->successful());
    }

    /** @test */
    public function it_can_confirm_whether_the_response_was_unsuccessful()
    {
        $code = 400;
        $contentData = [
            'content' => 'here'
        ];
        $content = json_encode($contentData);

        $response = new Response($code, $content);

        $this->assertFalse($response->successful());
    }
}
