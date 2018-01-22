<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
//        $response = $this->json('get','/api/post/4');
//
//        $response->assertStatus(200)
//            ->assertJson([
//                'status'=>true
//            ]);

        $this->assertDatabaseHas('posts',[
            'title'=>'11'
        ]);


    }
}
