<?php

namespace App\Repositories;

use App\Models\UserProjectTSToolU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTSToolURepository
 * @package App\Repositories
 * @version June 18, 2018, 9:01 pm UTC
 *
 * @method UserProjectTSToolU findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTSToolU find($id, $columns = ['*'])
 * @method UserProjectTSToolU first($columns = ['*'])
*/
class UserProjectTSToolURepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_p_t_s_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserProjectTSToolU::class;
    }
}
