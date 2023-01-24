<?php

namespace Tests\Feature;

use App\Http\Controllers\AdminController;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class adminTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testInsert()
    {
        $this->post('/admin/create', ['username' => 'admin', 'password' => '123']);

        $adm = Admin::where('username', '=', 'admin')->where('password', '=', '123')->first();

        self::assertEquals('admin', $adm->username);
        self::assertEquals('123', $adm->password);
    }

    public function testGet()
    {
        $admins = new AdminController;
        $admins->getAdmins();

        foreach ($admins as $admin) {
            self::assertEquals('admin', $admin->username);
            self::assertEquals('123', $admin->password);
        }
    }
}
