<?php

namespace App\Repositories;

use App\Models\UserCollegeTopic;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTopicRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:46 pm UTC
 *
 * @method UserCollegeTopic findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTopic find($id, $columns = ['*'])
 * @method UserCollegeTopic first($columns = ['*'])
*/
class UserCollegeTopicRepository extends BaseRepository
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
        'college_topic_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserCollegeTopic::class;
    }
}
