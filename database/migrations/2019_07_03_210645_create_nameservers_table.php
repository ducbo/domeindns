<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateNameserversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nameservers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->nullable();
            $table->boolean('default')->default(false);

            $table->string('nameserver');
            $table->string('ipv4');
            $table->string('ipv6');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });

        DB::table('nameservers')->insert(
            [
                'id' => Str::uuid(),
                'default' => true,
                'nameserver' => 'ns1.pdns.win',
                'ipv4' => '139.99.56.58',
                'ipv6' => '2402:1f00:8000:800:0:0:0:1149',
            ]
        );

        DB::table('nameservers')->insert(
            [
                'id' => Str::uuid(),
                'default' => true,
                'nameserver' => 'ns2.pdns.win',
                'ipv4' => '51.79.128.186',
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nameservers');
    }
}
