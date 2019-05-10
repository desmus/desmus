<?php

namespace App\Repositories;

use App\Models\UserProjectTopicU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTopicURepository
 * @package App\Repositories
 * @version June 18, 2018, 8:59 pm UTC
 *
 * @method UserProjectTopicU findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTopicU find($id, $columns = ['*'])
 * @method UserProjectTopicU first($columns = ['*'])
*/
class UserProjectTopicURepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_p_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserProjectTopicU::class;
    }
}
