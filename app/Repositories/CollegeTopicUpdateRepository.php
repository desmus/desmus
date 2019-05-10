<?php

namespace App\Repositories;

use App\Models\CollegeTopicUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTopicUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:50 pm UTC
 *
 * @method CollegeTopicUpdate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTopicUpdate find($id, $columns = ['*'])
 * @method CollegeTopicUpdate first($columns = ['*'])
*/
class CollegeTopicUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'college_topic_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTopicUpdate::class;
    }
}
