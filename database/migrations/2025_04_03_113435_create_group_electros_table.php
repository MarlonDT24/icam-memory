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
        Schema::create('group_electros', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('budget_excel');
            $table->string('cover')->nullable();
            $table->text('holder');
            $table->text('address');
            $table->text('cod_address');
            $table->string('cif', 20);
            $table->text('name_agent');
            $table->string('nif', 20);
            $table->text('location');
            $table->text('cod_location');
            $table->text('name_location');
            $table->text('build');
            $table->decimal('kva', 8, 2);
            $table->decimal('kw', 8, 2);
            $table->string('tension_type');
            $table->decimal('budget', 12, 2);
            $table->string('type_clasi');
            $table->string('mark');
            $table->string('model');
            $table->string('voltage');
            $table->string('image_model');
            $table->string('image_dimensions');
            $table->decimal('air_entry', 8, 2);
            $table->decimal('air_flow', 8, 2);
            $table->decimal('w', 8, 2);
            $table->decimal('factor', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_electros');
    }
};
