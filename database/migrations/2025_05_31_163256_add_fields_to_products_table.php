<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('type')->default('produit'); // produit ou service
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);

            // Optionnels pour les cours
            $table->enum('level', ['advanced', 'intermediate', 'beginner', 'all level'])->nullable();
            $table->integer('duration')->nullable(); // en minutes
            $table->timestamp('start_at')->nullable(); // date de début si service programmé


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'type',
                'description',
                'is_active',
                'enum',
                'duration',
                'start_at',
            ]);
        });
    }
}
