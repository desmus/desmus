<?php

namespace App\Repositories;

use App\Models\CollegeUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:50 pm UTC
 *
 * @method CollegeUpdate findWithoutFail($id, $columns = ['*'])
 * @method CollegeUpdate find($id, $columns = ['*'])
 * @method CollegeUpdate first($columns = ['*'])
*/
class CollegeUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'college_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeUpdate::class;
    }
}
