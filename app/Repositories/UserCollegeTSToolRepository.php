<?php

namespace App\Repositories;

use App\Models\UserCollegeTSTool;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTSToolRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:47 pm UTC
 *
 * @method UserCollegeTSTool findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTSTool find($id, $columns = ['*'])
 * @method UserCollegeTSTool first($columns = ['*'])
*/
class UserCollegeTSToolRepository extends BaseRepository
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
        'college_t_s_tool_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserCollegeTSTool::class;
    }
}
