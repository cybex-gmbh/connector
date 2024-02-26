<?php

namespace Database\Seeders;

use Artisan;
use DB;
use Illuminate\Database\Seeder;

class PullPreviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Artisan::call(sprintf('create:user %s', env('PULLPREVIEW_CONNECTOR_USER_PUBLICKEY', '<PULLPREVIEW_CONNECTOR_USER_PUBLICKEY env was not set>')));

        DB::table('personal_access_tokens')->where('id', 1)->update(['token' => env('PULLPREVIEW_CONNECTOR_PROTECTOR_AUTH_TOKEN_HASH', '<PULLPREVIEW_CONNECTOR_PROTECTOR_AUTH_TOKEN_HASH env was not set>')]);
    }
}
