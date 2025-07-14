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
        Schema::create('evaluasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Relasi ke users
            $table->date('periode'); // bulan evaluasi
            $table->decimal('total_jam_kerja', 5, 2)->default(0); // ex: 40.75
            $table->integer('jumlah_tugas_selesai')->default(0);
            $table->tinyInteger('nilai_kehadiran')->default(0); // 0-10
            $table->tinyInteger('nilai_tugas')->default(0);     // 0-10
            $table->tinyInteger('nilai_akhir')->default(0);     // total
            $table->string('penilaian'); // 'Excellent' atau 'Butuh Evaluasi'
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Foreign key ke tabel users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Tidak boleh dobel evaluasi untuk user dan periode yang sama
            $table->unique(['user_id', 'periode']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluasis');
    }
};
