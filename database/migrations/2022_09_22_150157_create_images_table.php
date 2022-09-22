<?php

use App\Enums\AcceptanceStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image');
            $table->string('image_file_name');
            $table->string('accepted')->default(AcceptanceStatus::NOT_DEFINED->value);
            $table->foreignId('album_id');
            $table->foreign('album_id')->on('albums')->references('id')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('images');
    }
};