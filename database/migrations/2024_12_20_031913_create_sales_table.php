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
    Schema::hasTable('sales', function (Blueprint $table) {
        $table->integer('SaleID', 11)->autoIncrement();
        $table->date('SaleDate');
        $table->foreignId('CustomerID')->contrained('customers');
        $table->foreignId('CarID')->constrained('cars');
        $table->foreignId('DealerID')->constrained('dealers');
        $table->timestamps();

        // Foreign key relationships
        $table->foreign('CustomerID')->references('CustomerID')->on('customers');
        $table->foreign('CarID')->references('CarID')->on('cars');
        $table->foreign('DealerID')->references('DealerID')->on('dealers');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
