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
        Schema::table('telegram_messages', function (Blueprint $table) {
            $table->bigInteger('parent_message_id')->after('message_id')->nullable();

            $table->index('message_id');

            $table->foreign('parent_message_id')
                ->references('message_id')
                ->on('telegram_messages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('telegram_messages', function (Blueprint $table) {
            $table->dropForeign(['patent_message_id']);
            $table->dropColumn('patent_message_id');
        });
    }
};
