<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('email')->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->date('membership_start')->nullable();
            $table->date('membership_end')->nullable();
            $table->enum('gender', ['laki-laki', 'perempuan']);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};

