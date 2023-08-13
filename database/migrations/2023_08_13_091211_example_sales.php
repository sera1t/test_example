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
        Schema::create('sales', function (Blueprint $table){
            $table->id();
            $table->string('g_number');
            $table->date('date');
            $table->date('last_change_date');
            $table->string('supplier_article');
            $table->string('tech_size');
            $table->string('barcode');
            $table->string('total_price');
            $table->string('discount_percent');
            $table->string('is_supply');
            $table->string('is_realization');
            $table->string('promo_code_discount');
            $table->string('warehouse_name');
            $table->string('country_name');
            $table->string('oblast_okrug_name');
            $table->string('region_name');
            $table->string('income_id');
            $table->string('sale_id');
            $table->string('odid');
            $table->string('spp');
            $table->string('for_pay');
            $table->string('finished_price');
            $table->string('price_with_disc');
            $table->string('nm_id');
            $table->string('subject');
            $table->string('category');
            $table->string('brand');
            $table->string('is_storno');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
