<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRumahSakitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('alamat');
            $table->string('no_ktp');
            $table->string('no_hp', 50);
            $table->string('no_rm', 25);
            $table->timestamps();
        });
        Schema::create('obats', function (Blueprint $table) {
            $table->id();
            $table->string('nama_obat', 50);
            $table->string('kemasan', 35);
            $table->integer('harga');
            $table->timestamps();
        });
        Schema::create('polis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_poli', 25);
            $table->text('keterangan');
            $table->timestamps();
        });

        Schema::create('dokters', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('alamat');
            $table->string('no_hp');
            $table->foreignId('poli_id')->constrained('polis')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('jadwalperiksas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dokter_id')->constrained('dokters')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->timestamps();
        });
        Schema::create('daftarpolis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')->constrained('pasiens')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('jadwalperiksa_id')->constrained('jadwalperiksas')->onUpdate('cascade')->onDelete('cascade');
            $table->text('keluhan');
            $table->integer('no_antrian');
            $table->timestamps();
        });
        Schema::create('periksas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daftarpoli_id')->constrained('daftarpolis')->onUpdate('cascade')->onDelete('cascade');
            $table->text('catatan');
            $table->dateTime('tgl_periksa');
            $table->integer('biaya_periksa');
            $table->timestamps();
        });
        Schema::create('detail_periksas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('periksa_id')->constrained('periksas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('obat_id')->constrained('obats')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pasiens');
        Schema::dropIfExists('obats');
        Schema::dropIfExists('polis');
        Schema::dropIfExists('dokters');
        Schema::dropIfExists('jadwalperiksas');
        Schema::dropIfExists('daftarpolis');
        Schema::dropIfExists('periksas');
        Schema::dropIfExists('detail_periksas');
    }
}
