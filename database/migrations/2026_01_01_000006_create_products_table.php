<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id')->unique();
            $table->string('name');
            $table->float('net_content_value')->nullable();
            $table->string('net_content_unit')->nullable();
            $table->integer('total_quantity')->nullable();
            $table->foreignId('pharmaceutical_form_id')
                ->constrained('pharmaceutical_forms')
                ->cascadeOnDelete();
            $table->string('composition_reference_amount');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
