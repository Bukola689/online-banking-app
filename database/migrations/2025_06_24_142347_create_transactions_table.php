<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->index('transfer','reference','index');
            $table->foreignId('user_id')->nullable()->contrained('users')->nullOnDelete();
            $table->foreignId('account_id')->nullable()->contrained('accounts')->nullOnDelete();
            $table->foreignId('transfer_id')->nullable()->contrained('accounts')->nullOnDelete();
            
            $table->decimal('amount', 16, 4);
            $table->decimal('balance', 16, 4); 
            $table->string('category'); // withdraw, Deposite
            $table->boolean('confirmed')->default(0);
            $table->dateTime('date');
            $table->string('description')->nullable();
            $table->text('meta')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('transactions');
    }
}
