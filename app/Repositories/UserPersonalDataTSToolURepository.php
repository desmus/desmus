<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTSToolU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTSToolURepository
 * @package App\Repositories
 * @version June 18, 2018, 9:01 pm UTC
 *
 * @method UserPersonalDataTSToolU findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTSToolU find($id, $columns = ['*'])
 * @method UserPersonalDataTSToolU first($columns = ['*'])
*/
class UserPersonalDataTSToolURepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'u_p_d_t_s_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserPersonalDataTSToolU::class;
    }
}
