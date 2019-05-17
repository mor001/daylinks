<?php

namespace Tests\Feature;

use App\Schedule;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Artisan;

class ScheduleTest extends TestCase
{
    // テスト実行
    // ./vendor/bin/phpunit tests/Unit/ScheduleTest.php

    //use RefreshDatabase;
    public function setUp() {
        parent::setUp();
        Artisan::call('migrate:refresh');
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test1件だけ保存()
    {
        config(['tid' => 'test1']);
        Schedule::save2('2019-06-01', 'test title 0601', 'test description 0601', 1, '2019-05-01');
        $schedule = Schedule::where('date', '2019-06-01')->first();
        
        $this->assertEquals('test title 0601', $schedule->title);
    }
    public function test1件保存後同じキーで上書き保存()
    {
        config(['tid' => 'test1']);
        Schedule::save2('2019-06-01', 'test title 0601', 'test description 0601', 1, '2019-05-01');
        $schedule = Schedule::where('date', '2019-06-01')->first();
        
        $this->assertEquals('test title 0601', $schedule->title);
        
        Schedule::save2('2019-06-01', 'test title 0601-02', 'test description 0601-02', 1, '2019-05-01');
        $schedule = Schedule::where('date', '2019-06-01')->first();
        
        $this->assertEquals('test title 0601-02', $schedule->title);

    }
}
