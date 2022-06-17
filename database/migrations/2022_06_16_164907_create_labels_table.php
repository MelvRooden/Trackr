<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labels', function (Blueprint $table) {
            $table->id();
            $table->string('barcode_id')->unique();
            $table->bigInteger('package_status');
            $table->bigInteger('carrier_company');

            $table->unsignedBigInteger('sender_user_id')->nullable();
            $table->string('sender_address');
            $table->string('sender_city');
            $table->string('sender_postcode');

            $table->unsignedBigInteger('receiver_user_id')->nullable();
            $table->string('receiver_address');
            $table->string('receiver_city');
            $table->string('receiver_postcode');

            $table->timestamps();
        });

        Schema::table('labels', function (Blueprint $table): void {
            $table->foreign('sender_user_id')
                ->references('id')
                ->on('users');

            $table->foreign('receiver_user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('labels');
    }
};
