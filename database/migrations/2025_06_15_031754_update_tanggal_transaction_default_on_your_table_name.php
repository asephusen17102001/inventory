<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::table('transactions', function (Blueprint $table) {
            $table->dateTime('tanggal_transaction')
                ->nullable()
                ->default(DB::raw('CURRENT_TIMESTAMP'))
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('transactions', function (Blueprint $table) {
            $table->dateTime('tanggal_transaction')
                ->nullable()
                ->default(null)
                ->change();
        });
    }
};
