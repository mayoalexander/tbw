<?php namespace Thebaewatch\Thebaewatch\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateThebaewatchThebaewatchModelsRoles extends Migration
{
    public function up()
    {
        Schema::table('thebaewatch_thebaewatch_models_roles', function($table)
        {
            $table->dropPrimary(['models_id','roles']);
            $table->renameColumn('roles', 'roles_id');
            $table->primary(['models_id','roles_id']);
        });
    }
    
    public function down()
    {
        Schema::table('thebaewatch_thebaewatch_models_roles', function($table)
        {
            $table->dropPrimary(['models_id','roles_id']);
            $table->renameColumn('roles_id', 'roles');
            $table->primary(['models_id','roles']);
        });
    }
}
