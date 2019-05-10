<?php

namespace App\Repositories;

use App\Models\CollegeTSToolDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSToolDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:55 pm UTC
 *
 * @method CollegeTSToolDelete findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSToolDelete find($id, $columns = ['*'])
 * @method CollegeTSToolDelete first($columns = ['*'])
*/
class CollegeTSToolDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'college_t_s_tool_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSToolDelete::class;
    }
}
