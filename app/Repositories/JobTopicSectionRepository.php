<?php

namespace App\Repositories;

use App\Models\JobTopicSection;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTopicSectionRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:45 pm UTC
 *
 * @method JobTopicSection findWithoutFail($id, $columns = ['*'])
 * @method JobTopicSection find($id, $columns = ['*'])
 * @method JobTopicSection first($columns = ['*'])
*/
class JobTopicSectionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'specific_info',
        'views_quantity',
        'updates_quantity',
        'status',
        'job_topic_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTopicSection::class;
    }
}
