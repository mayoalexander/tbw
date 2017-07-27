<?php namespace Thebaewatch\Thebaewatch\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateThebaewatchThebaewatchCategories extends Migration
{
    public function up()
    {
        Schema::table('thebaewatch_thebaewatch_categories', function($table)
        {
            $table->string('icon')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('thebaewatch_thebaewatch_categories', function($table)
        {
            $table->dropColumn('icon');
        });
    }
}
