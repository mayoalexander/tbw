<?php namespace Thebaewatch\Thebaewatch\Models;

use Model;

/**
 * Model
 */
class Models extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /*
     * Validation
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'thebaewatch_thebaewatch_models';


    /* RELATIONS */

    public $attachMany = [
        'gallery' => 'System\Models\File'
    ];


    public $belongsToMany = [

        'categories' => [

            'Thebaewatch\Thebaewatch\Models\Categories',
            'table' => 'thebaewatch_thebaewatch_models_categories',
            'order' => 'id desc',

        ],
        'roles' => [

            'Thebaewatch\Thebaewatch\Models\Roles',
            'table' => 'thebaewatch_thebaewatch_models_roles',
            'order' => 'id desc',

        ],

    ];
}