<?php

namespace App\Repositories;

use App\Models\CollegeTSToolUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSToolUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:51 pm UTC
 *
 * @method CollegeTSToolUpdate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSToolUpdate find($id, $columns = ['*'])
 * @method CollegeTSToolUpdate first($columns = ['*'])
*/
class CollegeTSToolUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'college_t_s_tool_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSToolUpdate::class;
    }
}
