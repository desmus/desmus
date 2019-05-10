<?php

namespace App\Repositories;

use App\Models\JobTopicDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTopicDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:53 pm UTC
 *
 * @method JobTopicDelete findWithoutFail($id, $columns = ['*'])
 * @method JobTopicDelete find($id, $columns = ['*'])
 * @method JobTopicDelete first($columns = ['*'])
*/
class JobTopicDeleteRepository extends BaseRepository
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
        return JobTopicDelete::class;
    }
}
