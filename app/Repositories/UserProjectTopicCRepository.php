<?php

namespace App\Repositories;

use App\Models\UserProjectTopicC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTopicCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:53 pm UTC
 *
 * @method UserProjectTopicC findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTopicC find($id, $columns = ['*'])
 * @method UserProjectTopicC first($columns = ['*'])
*/
class UserProjectTopicCRepository extends BaseRepository
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
        return UserProjectTopicC::class;
    }
}
