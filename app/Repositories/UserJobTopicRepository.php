<?php

namespace App\Repositories;

use App\Models\UserJobTopic;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTopicRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:46 pm UTC
 *
 * @method UserJobTopic findWithoutFail($id, $columns = ['*'])
 * @method UserJobTopic find($id, $columns = ['*'])
 * @method UserJobTopic first($columns = ['*'])
*/
class UserJobTopicRepository extends BaseRepository
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
        'job_topic_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserJobTopic::class;
    }
}
