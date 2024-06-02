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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->text('start_date');
            $table->text('start_date_timestamp');
            $table->text('start_datetime');
            $table->text('start_datetime_timestamp');
            $table->text('end_date');
            $table->text('end_date_timestamp');
            $table->text('end_datetime');
            $table->text('end_datetime_timestamp');
            $table->integer('percentage');
            $table->text('image');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
