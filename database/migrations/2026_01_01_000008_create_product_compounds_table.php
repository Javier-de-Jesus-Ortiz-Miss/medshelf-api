<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_compounds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('active_compound_id')
                ->constrained('active_compounds');
            $table->foreignId('product_id')
                ->constrained('products');
            $table->float('concentration_value');
            $table->string('concentration_unit');
            $table->float('base_amount');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_compounds');
    }
};
