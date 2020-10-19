<?php
declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;
use Phpmig\Migration\Migration;

class CreateProperty extends Migration
{
	private string $table;

    private Builder $schema;

	public function init()
    {
        $this->table = 'properties';
        $this->schema = $this->get('schema');

        parent::init();
    }

    public function up(): void
    {
        $this->schema->create($this->table, function (Blueprint $table) {

            $table->increments('id');
            $table->string('uuid', 36);
            $table->string('county', 32);
            $table->string('country', 64);
            $table->string('town', 32);
            $table->text('description');
            $table->string('address', 64);
            $table->string('image_full', 128);
            $table->string('image_thumbnail', 128);
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->unsignedTinyInteger('num_bedrooms');
            $table->unsignedTinyInteger('num_bathrooms');
            $table->integer('price');
            $table->string('type', 8);
            $table->string('property_type_title', 32);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

            $table->unique('uuid');
        });
    }

    public function down(): void
    {
        $this->schema->dropIfExists($this->table);
    }
}
