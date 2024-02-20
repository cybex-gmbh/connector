<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPublicKeyToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('connector.secondary_database.connection'))->table('users', function (Blueprint $table) {
            $table->string('protector_public_key')->unique()->nullable()->comment(
                'The sodium public key for the Protector package.'
            );
        });
    }
}
