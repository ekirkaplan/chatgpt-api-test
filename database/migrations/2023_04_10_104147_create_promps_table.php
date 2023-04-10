<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('promps', function (Blueprint $table) {
            $table->id();
            $table->string('promp')->index();
            $table->text('context');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('promps');
    }
};
