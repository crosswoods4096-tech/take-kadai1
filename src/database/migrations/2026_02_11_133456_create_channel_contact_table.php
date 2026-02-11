<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelContactTable extends Migration
{
    public function up(): void
    {
        Schema::create('channel_contact', function (Blueprint $table) {
            $table->id();

            $table->foreignId('contact_id')
                ->constrained('contacts')
                ->onDelete('cascade');

            $table->foreignId('channel_id')
                ->constrained('channels')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('channel_contact');
    }
}
