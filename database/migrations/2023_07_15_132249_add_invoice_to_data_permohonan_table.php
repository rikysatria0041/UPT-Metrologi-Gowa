<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInvoiceToDataPermohonanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_permohonan', function (Blueprint $table) {
            $table->string('invoice')->after('tgl_approved_super_admin')->nullable();
            $table->string('bukti_bayar')->after('invoice')->nullable();
            $table->string('jadwal')->after('bukti_bayar')->nullable();
            $table->string('file_sk')->after('jadwal')->nullable();
            $table->timestamp('masa_berlaku')->after('file_sk')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_permohonan', function (Blueprint $table) {
            $table->dropColumn('invoice');
            $table->dropColumn('bukti_bayar');
            $table->dropColumn('jadwal');
            $table->dropColumn('file_sk');
            $table->dropColumn('masa_berlaku');
        });
    }
}
