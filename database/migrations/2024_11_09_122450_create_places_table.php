<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categorys', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
        });

        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
        });

        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->string('rate');
            $table->timestamps();
        });

        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->decimal('harga', 8, 0);
            $table->enum('kategori_harga', ['murah', 'sedang', 'mahal']);
            $table->timestamps();
        });

        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
        });

        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi');
            $table->string('alamat');
            $table->string('foto')->nullable();
            $table->foreignId('kategori_id')->constrained('categorys');
            $table->foreignId('lokasi_id')->constrained('locations');
            $table->foreignId('rating_id')->constrained('ratings');
            $table->foreignId('tiket_id')->constrained('tickets');
            $table->timestamps();
        });

        Schema::create('facility_place', function (Blueprint $table) {
            $table->id();
            $table->foreignId('place_id')
                ->constrained('places')
                ->cascadeOnDelete();
            $table->foreignId('facility_id')
                ->constrained('facilities')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        // Urutan penghapusan tabel yang benar
        Schema::dropIfExists('facility_place');
        Schema::dropIfExists('places');
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('facilities');
        Schema::dropIfExists('ratings');
        Schema::dropIfExists('locations');
        Schema::dropIfExists('categorys');
    }
};
