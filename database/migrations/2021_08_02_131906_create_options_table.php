<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('site_name');
            $table->string('site_title');
            $table->string('site_desc');
            $table->string('contact_email');
            $table->string('contact_phone');
            $table->string('site_logo');
            $table->string('footer_text');
            $table->string('currency_format');
            $table->string('contact_address');
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
        Schema::dropIfExists('options');
    }
}
