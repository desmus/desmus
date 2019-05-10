<?php

namespace App\Repositories;

use App\Models\CollegeCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:47 pm UTC
 *
 * @method CollegeCreate findWithoutFail($id, $columns = ['*'])
 * @method CollegeCreate find($id, $columns = ['*'])
 * @method CollegeCreate first($columns = ['*'])
*/
class CollegeCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'college_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeCreate::class;
    }
}
