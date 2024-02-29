<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermohonanTeraUlangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permohonan_tera_ulang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('jenis_alat_id');
            $table->foreign('jenis_alat_id')->references('id')->on('jenis_alat')->onDelete('cascade');
            $table->string('kapasitas', 100);
            $table->string('merk', 200);
            $table->string('model_type', 200);
            $table->string('IDPermohonan', 25)->nullable();
            $table->string('file')->nullable()->comment('khusus untuk jenis alat = nozzle');
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
        Schema::dropIfExists('permohonan_tera_ulang');
    }
}
