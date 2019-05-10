<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTopic;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTopicRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:46 pm UTC
 *
 * @method UserPersonalDataTopic findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTopic find($id, $columns = ['*'])
 * @method UserPersonalDataTopic first($columns = ['*'])
*/
class UserPersonalDataTopicRepository extends BaseRepository
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
        'personal_data_topic_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserPersonalDataTopic::class;
    }
}
