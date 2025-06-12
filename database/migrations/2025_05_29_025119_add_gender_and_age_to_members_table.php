<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->integer('age')->after('name')->nullable(); // atau after('id') jika ingin setelah ID
            $table->enum('gender', ['laki-laki', 'perempuan'])->after('age')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn(['age', 'gender']);
        });
    }
};
