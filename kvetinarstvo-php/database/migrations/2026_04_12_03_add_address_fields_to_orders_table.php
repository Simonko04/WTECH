<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('email', 255)->after('user_id');
            $table->foreignId('billing_address_id')
                  ->nullable()
                  ->after('email')
                  ->constrained('billing_addresses')
                  ->nullOnDelete();
            $table->foreignId('shipping_address_id')
                  ->nullable()
                  ->after('billing_address_id')
                  ->constrained('shipping_addresses')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropConstrainedForeignId('billing_address_id');
            $table->dropConstrainedForeignId('shipping_address_id');
            $table->dropColumn('email');
        });
    }
};
