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
        Schema::table('appointment', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->string('payment_status')->default('waiting')->after('time');
            $table->string('midtrans_url')->nullable()->after('payment_status');
            $table->string('midtrans_booking_code')->nullable()->after('midtrans_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointment', function (Blueprint $table) {
            $table->enum('status', [1, 2]);
            $table->dropColumn(['payment_status', 'midtrans_url', 'midtrans_booking_code']);
        });
    }
};
