<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::hasTable('cars', function (Blueprint $table) {
        $table->string('CarID', 50);
        $table->string('Company', 100);
        $table->string('Model', 100);
        $table->string('Engine', 50);
        $table->string('Transmission', 50);
        $table->string('BodyStyle', 50);
        $table->string('Color', 50);
        $table->integer('Price', 11);
        $table->float('PriceNorm');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
