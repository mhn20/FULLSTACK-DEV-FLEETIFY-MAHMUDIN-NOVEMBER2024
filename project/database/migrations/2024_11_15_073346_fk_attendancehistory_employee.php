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
        Schema::table('attendance_history', function (Blueprint $table) {
            
            // Ubah tipe data kolom
            $table->string('employee_id', 50)->change();
            
            // Tambahkan kembali foreign key setelah tipe data diubah
            $table->foreign('employee_id')->references('employee_id')->on('employee')->onDelete('cascade');
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
