<?php

namespace App\Repositories;

use App\Models\UserJobTSTool;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTSToolRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:47 pm UTC
 *
 * @method UserJobTSTool findWithoutFail($id, $columns = ['*'])
 * @method UserJobTSTool find($id, $columns = ['*'])
 * @method UserJobTSTool first($columns = ['*'])
*/
class UserJobTSToolRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'description',
        'status',
        'permissions',
        'user_id',
        'job_t_s_tool_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserJobTSTool::class;
    }
}
