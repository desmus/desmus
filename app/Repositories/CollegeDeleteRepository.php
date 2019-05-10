<?php

namespace App\Repositories;

use App\Models\CollegeDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:52 pm UTC
 *
 * @method CollegeDelete findWithoutFail($id, $columns = ['*'])
 * @method CollegeDelete find($id, $columns = ['*'])
 * @method CollegeDelete first($columns = ['*'])
*/
class CollegeDeleteRepository extends BaseRepository
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
        return CollegeDelete::class;
    }
}
