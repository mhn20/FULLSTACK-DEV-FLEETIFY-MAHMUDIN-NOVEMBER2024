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

        Schema::table('attendance', function (Blueprint $table) {
            $table->string('attendance_id', 100)->unique(true)->change();
        });
        Schema::table('attendance_history', function (Blueprint $table) {
            
            // $table->dropColumn(['attendance_id']);

            // Ubah tipe data kolom
            $table->string('attendance_id', 100)->change();
            
            // Tambahkan kembali foreign key setelah tipe data diubah
            $table->foreign('attendance_id')->references('attendance_id')->on('attendance')->onDelete('cascade');

            // $table->unique(['attendance_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
