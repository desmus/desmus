<?php

namespace App\Repositories;

use App\Models\UserProjectTSTool;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTSToolRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:47 pm UTC
 *
 * @method UserProjectTSTool findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTSTool find($id, $columns = ['*'])
 * @method UserProjectTSTool first($columns = ['*'])
*/
class UserProjectTSToolRepository extends BaseRepository
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
        'project_t_s_tool_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserProjectTSTool::class;
    }
}
