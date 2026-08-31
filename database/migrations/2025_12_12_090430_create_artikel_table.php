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
            Schema::create('artikel', function (Blueprint $table) {
                $table->id();
                $table->string('judul');
                $table->string('oleh');
                $table->string('slug')->unique();
                $table->longText('konten');
                $table->string('thumbnail')->nullable();
                $table->enum('status', ['draft', 'published'])->default('draft');
                $table->integer('views')->default(0);
                $table->timestamp('published_at')->nullable();
                $table->date('tanggal');
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('artikel');
        }
    };
