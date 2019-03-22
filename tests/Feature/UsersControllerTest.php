<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Artisan;

class UsersControllerTest extends TestCase
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
    public function testユーザー一覧取得()
    {
        // configにサブドメイン埋め込み
        config(['tid' => self::SUBDOMAIN]);

        // テストするURLを指定
        $url = self::HOST.'/admin/users/list';

        // 認証情報設定
        $credentials = array('userid' => 'admin', 'password' => 'aaa111');

        // 認証してJWTトークンを取得する
        if(!$token = auth('admin')->attempt($credentials)){
            echo "トークン取得失敗\n";
        }

        // 取得したJWTトークンをヘッダーに埋め込む
        $headers = ['Authorization' => 'Bearer ' . $token];
        
        // パラメータ
        $params = [];

        // HTTPアクセス
        $response = $this->json('GET', $url, $params, $headers);

        // ステータスコードが200で返ってきているか
        $response->assertStatus(200);
        // resultはtrueが返ってきているか
        $response->assertJson(['result' => true,]);
        // レスポンスデータ内には指定された文字が存在するか
        $response->assertSee('muto');           // test1事業者のユーザーが返ってきていること
        $response->assertDontSee('misawa');     // test2事業者のユーザーは帰ってきていないこと
        //$response->assertDontSee('chono');    // test1事業者のユーザーなのでテストがコケる
    }
}
