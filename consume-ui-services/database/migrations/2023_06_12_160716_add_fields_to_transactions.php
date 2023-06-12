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
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('fullname')->nullable()->after('total_price');
            $table->string('email')->nullable()->after('fullname');
            $table->text('address')->nullable()->after('email');
            $table->string('kotaasal')->nullable()->after('address');
            $table->string('kotatujuan')->nullable()->after('kotaasal');
            $table->integer('weight')->nullable()->after('kotatujuan');
            $table->string('courier')->nullable()->after('weight');
            $table->string('paymentMethod')->nullable()->after('courier');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            //
        });
    }
};
