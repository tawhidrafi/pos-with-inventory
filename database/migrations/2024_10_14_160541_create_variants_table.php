 <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateVariantsTable extends Migration
    {
        public function up()
        {
            Schema::create('variants', function (Blueprint $table) {
                $table->id();
                $table->foreignId('product_id')->constrained()->onDelete('cascade');
                $table->string('variant_name');
                $table->string('variant_code')->unique();
                $table->decimal('cost', 8, 2)->default(0.00);
                $table->decimal('price', 8, 2)->default(0.00);
                $table->integer('stock')->default(0);
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('variants');
        }
    }
