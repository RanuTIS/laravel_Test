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
        Schema::create('shop_details', function (Blueprint $table) {
            $table->id();
            $table->string('shop_url');
            $table->bigInteger('shop_id');
            $table->string('shop_name');
            $table->string('custom_domain');
            $table->string('admin_email');
            $table->string('admin_name');
            $table->string('more_details');
            $table->longText("shop_json");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_details');
    }
};
