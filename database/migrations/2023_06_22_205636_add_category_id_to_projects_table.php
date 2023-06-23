<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('category_id')->nullable()->after('id');
            //qui inizia relazione
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            //
            //qui cancello la relazione tra le tabelle
            $table->dropForeign('projects_category_id_foreign');
            //qui colonna tabella
            $table->dropColumn('category_id');
        });
    }
};