<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasColumn('kategoris', 'slug_Kaegori')
            && ! Schema::hasColumn('kategoris', 'slug_Kategori')) {
            Schema::table('kategoris', function (Blueprint $table): void {
                $table->renameColumn('slug_Kaegori', 'slug_Kategori');
            });
        }

        if (! Schema::hasColumn('kategoris', 'deskripsi')) {
            Schema::table('kategoris', function (Blueprint $table): void {
                $table->string('deskripsi')->nullable()->after('slug_Kategori');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('kategoris', 'deskripsi')) {
            Schema::table('kategoris', function (Blueprint $table): void {
                $table->dropColumn('deskripsi');
            });
        }

        if (Schema::hasColumn('kategoris', 'slug_Kategori')
            && ! Schema::hasColumn('kategoris', 'slug_Kaegori')) {
            Schema::table('kategoris', function (Blueprint $table): void {
                $table->renameColumn('slug_Kategori', 'slug_Kaegori');
            });
        }
    }
};
