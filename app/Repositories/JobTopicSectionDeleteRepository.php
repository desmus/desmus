<?php

namespace App\Repositories;

use App\Models\JobTopicSectionDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTopicSectionDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:53 pm UTC
 *
 * @method JobTopicSectionDelete findWithoutFail($id, $columns = ['*'])
 * @method JobTopicSectionDelete find($id, $columns = ['*'])
 * @method JobTopicSectionDelete first($columns = ['*'])
*/
class JobTopicSectionDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'job_topic_section_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTopicSectionDelete::class;
    }
}
