<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTSTool;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTSToolRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:47 pm UTC
 *
 * @method UserPersonalDataTSTool findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTSTool find($id, $columns = ['*'])
 * @method UserPersonalDataTSTool first($columns = ['*'])
*/
class UserPersonalDataTSToolRepository extends BaseRepository
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
        'personal_data_t_s_tool_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserPersonalDataTSTool::class;
    }
}
