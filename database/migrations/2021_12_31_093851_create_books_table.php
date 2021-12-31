<?php

use App\Constants\TYPEConstant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->unique();
            $table->string('description')->nullable()->unique();
            $table->boolean('is_active')->default(true)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->unsignedBigInteger('added_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->enum('type', [TYPEConstant::TYPE])->default(TYPEConstant::TYPE['FREE']);
            $table->double('price')->default('0')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->char('publisher')->nullable()->unique();
            $table->json('meta')->nullable();
            $table->tinyInteger('stock')->nullable();
            $table->tinyText('code')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
