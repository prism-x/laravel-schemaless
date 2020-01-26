<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('_documents', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('model');
            $table->string('collection')->default('documents');
            $table->string('locale');
            $table->jsonb('_attributes');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('_documents');
    }
}
