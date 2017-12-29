<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('company_id');
            $table->integer('package_id')->nullable();
            $table->string('event_name');
            $table->string('message')->nullable();
            $table->integer('expectedVisitors');
            $table->date('date_start');
            $table->string('time_start');
            $table->integer('status')->nullable();
            $table->char('client_contact');
            $table->string('address_lat')->nullable();
            $table->string('address_lng')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
