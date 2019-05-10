<?php

namespace App\Repositories;

use App\Models\College;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:45 pm UTC
 *
 * @method College findWithoutFail($id, $columns = ['*'])
 * @method College find($id, $columns = ['*'])
 * @method College first($columns = ['*'])
*/
class CollegeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'specific_info',
        'views_quantity',
        'updates_quantity',
        'status',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return College::class;
    }
}
