<?php

namespace App\Repositories;

use App\Models\JobTopicCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTopicCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:48 pm UTC
 *
 * @method JobTopicCreate findWithoutFail($id, $columns = ['*'])
 * @method JobTopicCreate find($id, $columns = ['*'])
 * @method JobTopicCreate first($columns = ['*'])
*/
class JobTopicCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'job_topic_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTopicCreate::class;
    }
}
