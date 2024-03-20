<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('customer_inquiries', function (Blueprint $table) {
            $table->string('inq_subject')->after('status');
            $table->string('ans_subject')->after('inquiry_details');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_inquiries', function (Blueprint $table) {
            $table->string('inq_subject')->after('status');
            $table->string('ans_subject')->after('inquiry_details');

        });
    }
};
