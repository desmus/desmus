<?php

namespace App\Repositories;

use App\Models\UserProjectTopicD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTopicDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:03 pm UTC
 *
 * @method UserProjectTopicD findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTopicD find($id, $columns = ['*'])
 * @method UserProjectTopicD first($columns = ['*'])
*/
class UserProjectTopicDRepository extends BaseRepository
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
        return UserProjectTopicD::class;
    }
}
