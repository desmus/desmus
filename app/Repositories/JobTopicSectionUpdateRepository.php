<?php

namespace App\Repositories;

use App\Models\JobTopicSectionUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTopicSectionUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:51 pm UTC
 *
 * @method JobTopicSectionUpdate findWithoutFail($id, $columns = ['*'])
 * @method JobTopicSectionUpdate find($id, $columns = ['*'])
 * @method JobTopicSectionUpdate first($columns = ['*'])
*/
class JobTopicSectionUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'description',
        'user_id',
        'job_topic_section_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTopicSectionUpdate::class;
    }
}
