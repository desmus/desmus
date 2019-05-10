<?php

namespace App\Repositories;

use App\Models\JobTopicUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTopicUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:51 pm UTC
 *
 * @method JobTopicUpdate findWithoutFail($id, $columns = ['*'])
 * @method JobTopicUpdate find($id, $columns = ['*'])
 * @method JobTopicUpdate first($columns = ['*'])
*/
class JobTopicUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'job_topic_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTopicUpdate::class;
    }
}
