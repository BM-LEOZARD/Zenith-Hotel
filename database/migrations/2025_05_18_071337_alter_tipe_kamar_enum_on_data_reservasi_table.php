    <?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Support\Facades\DB;

    return new class extends Migration
    {
        public function up(): void
        {
            DB::statement("ALTER TABLE data_reservasi MODIFY tipe_kamar ENUM('Standard', 'Superior', 'Deluxe', 'Executive') NOT NULL");
        }

        public function down(): void
        {
            DB::statement("ALTER TABLE data_reservasi MODIFY tipe_kamar ENUM('Single', 'Double', 'Suite') NOT NULL");
        }
    };
