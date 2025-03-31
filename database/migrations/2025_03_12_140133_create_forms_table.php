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
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cover')->nullable();
            $table->text('holder');
            $table->text('address');
            $table->text('cod_address');
            $table->string('cif', 20);
            $table->text('name_agent');
            $table->string('nif', 20);
            $table->text('location');
            $table->text('cod_location');
            $table->text('activity');
            $table->text('description');
            $table->decimal('m_parcels', 8, 2);
            $table->decimal('m_surface', 8, 2);
            $table->text('requirements');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};
