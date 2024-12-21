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
    Schema::hasTable('customers', function (Blueprint $table) {
        $table->integer('CustomerID', 11);
        $table->string('CustomerName', 100);
        $table->string('Gender', 20);
        $table->bigInteger('Phone', 20);
        $table->integer('AnnualIncome', 11);
        $table->float('AnnualIncomeNorm');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
