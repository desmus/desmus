<?php

namespace App\Repositories;

use App\Models\UserProjectTopic;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTopicRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:46 pm UTC
 *
 * @method UserProjectTopic findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTopic find($id, $columns = ['*'])
 * @method UserProjectTopic first($columns = ['*'])
*/
class UserProjectTopicRepository extends BaseRepository
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
        'project_topic_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserProjectTopic::class;
    }
}
