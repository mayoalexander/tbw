<?php namespace Thebaewatch\Thebaewatch\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateThebaewatchThebaewatchModels extends Migration
{
    public function up()
    {
        Schema::table('thebaewatch_thebaewatch_models', function($table)
        {
            $table->string('snapchat')->nullable();
            $table->string('youtube')->nullable();
            $table->string('soundcloud')->nullable();
            $table->increments('id')->unsigned(false)->change();
        });
    }
    
    public function down()
    {
        Schema::table('thebaewatch_thebaewatch_models', function($table)
        {
            $table->dropColumn('snapchat');
            $table->dropColumn('youtube');
            $table->dropColumn('soundcloud');
            $table->increments('id')->unsigned()->change();
        });
    }
}
