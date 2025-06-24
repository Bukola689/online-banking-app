<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->nullable()->contrained('users')->nullOnDelete();
            $table->foreignId('recipient_account_id')->nullable()->contrained('accounts')->nullOnDelete();
            $table->foreignId('recipient_account')->nullable()->contrained('accounts')->nullOnDelete();
            $table->foreignId('recipient_id')->nullable()->contrained('users')->nullOnDelete();
            $table->string('reference')->index('transfer','reference','index');
            $table->string('status');
            $table->decimal('amount', 16, 4);
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
        Schema::dropIfExists('transfers');
    }
}
