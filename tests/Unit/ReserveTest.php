<?php

namespace Tests\Feature;

use App\Reserve;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Artisan;

class ReserveTest extends TestCase
{
    // テスト実行
    // ./vendor/bin/phpunit tests/Unit/ScheduleTest.php

    //use RefreshDatabase;
    public function setUp() {
        parent::setUp();
        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');
    }
    public function test一ヵ月分取得()
    {
        config(['tid' => 'test1']);
        $reserve = new Reserve();
        $result = $reserve->getAdminMonthly(2019, 5);
        //$this->assertEquals('test1: 2019-05-01のイベントです。', $schedule->title);
        $obj = $result['list'][0]['schedule'];
        $this->assertEquals(count($obj->reserves), 3);
    }
}
