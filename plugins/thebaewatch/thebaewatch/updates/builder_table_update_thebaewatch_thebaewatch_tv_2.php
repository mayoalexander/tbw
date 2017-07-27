<?php namespace Thebaewatch\Thebaewatch\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateThebaewatchThebaewatchTv2 extends Migration
{
    public function up()
    {
        Schema::table('thebaewatch_thebaewatch_tv', function($table)
        {
            $table->string('type')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('thebaewatch_thebaewatch_tv', function($table)
        {
            $table->dropColumn('type');
        });
    }
}
