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
        Schema::create('location', function (Blueprint $table) {
            $table->id();
            $table->string('locationName');
            $table->string('shortName');
            $table->unsignedBigInteger('created_by')->nullable(); // User who created the record
            $table->unsignedBigInteger('updated_by')->nullable(); // User who last updated the record
            $table->timestamps();
            $table->enum('status', ['active', 'inactive'])->default('active'); // ENUM with default 'active'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location');
    }
};
