<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Artisan;
use App\Staff;
use App\Notice;

class NoticeTest extends TestCase
{
    const SUBDOMAIN = 'test1';
    const HOST = 'http://'.self::SUBDOMAIN.'.localhost2/api';

    public function setUp() {
        parent::setUp();
        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testテストだよーん()
    {
        config(['tid' => self::SUBDOMAIN]);

        $url = self::HOST.'/admin/me';

        $credentials = array('userid' => 'admin', 'password' => 'aaa111');

        if(!$token = auth('admin')->attempt($credentials)){
            //echo "トークン取得失敗\n";
        } else {
            //echo "トークン取得成功\n";
        }

        $headers = ['Authorization' => 'Bearer ' . $token];
        $params = [];
        $response = $this->json('GET', $url, $params, $headers);
        $response->assertStatus(200);

        //print_r($response->getData());
    }
}
