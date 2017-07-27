<?php namespace Thebaewatch\Thebaewatch\Models;

use Model;

/**
 * Model
 */
class Categories extends Model
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
    public $table = 'thebaewatch_thebaewatch_categories';



    public $attachMany = [
        'photos' => 'System\Models\File'
    ];


    public $belongsToMany = [
        'models' => [
            'Thebaewatch\Thebaewatch\Models\Models',
            'table' => 'thebaewatch_thebaewatch_models_categories',
            'order' => 'id desc',
        ],   
    ];
}