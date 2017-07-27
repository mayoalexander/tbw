<?php namespace Thebaewatch\Thebaewatch\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateThebaewatchThebaewatchModelsRoles extends Migration
{
    public function up()
    {
        Schema::create('thebaewatch_thebaewatch_models_roles', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('models_id');
            $table->integer('roles');
            $table->primary(['models_id','roles']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('thebaewatch_thebaewatch_models_roles');
    }
}
