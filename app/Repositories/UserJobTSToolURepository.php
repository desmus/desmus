<?php

namespace App\Repositories;

use App\Models\UserJobTSToolU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTSToolURepository
 * @package App\Repositories
 * @version June 18, 2018, 9:01 pm UTC
 *
 * @method UserJobTSToolU findWithoutFail($id, $columns = ['*'])
 * @method UserJobTSToolU find($id, $columns = ['*'])
 * @method UserJobTSToolU first($columns = ['*'])
*/
class UserJobTSToolURepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_j_t_s_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserJobTSToolU::class;
    }
}
