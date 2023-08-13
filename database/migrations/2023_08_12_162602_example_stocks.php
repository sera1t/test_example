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
        Schema::create('stocks', function (Blueprint $table){
            $table->id();
            $table->date('date');
            $table->date('last_change_date');
            $table->string('supplier_article');
            $table->string('tech_size');
            $table->string('barcode');
            $table->string('quantity');
            $table->string('is_supply');
            $table->string('is_realization');
            $table->string('quantity_full');
            $table->string('warehouse_name');
            $table->string('in_way_to_client');
            $table->string('in_way_from_client');
            $table->string('nm_id');
            $table->string('subject');
            $table->string('category');
            $table->string('brand');
            $table->string('sc_code');
            $table->string('price');
            $table->string('discount');
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
