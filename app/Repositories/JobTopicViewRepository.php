<?php

namespace App\Repositories;

use App\Models\JobTopicView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTopicViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:49 pm UTC
 *
 * @method JobTopicView findWithoutFail($id, $columns = ['*'])
 * @method JobTopicView find($id, $columns = ['*'])
 * @method JobTopicView first($columns = ['*'])
*/
class JobTopicViewRepository extends BaseRepository
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
        return JobTopicView::class;
    }
}
