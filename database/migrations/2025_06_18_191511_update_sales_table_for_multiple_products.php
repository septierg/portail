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
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn(['product_name', 'quantity', 'unit_price']);
            // Le total de la vente reste
            // $table->decimal('total_price', 10, 2)->nullable()->change(); (optionnel selon logique)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->string('product_name')->nullable(); // si besoin
            $table->integer('quantity')->default(1);
            $table->decimal('unit_price', 8, 2)->default(0);
        });
    }
};
