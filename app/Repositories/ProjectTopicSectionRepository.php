<?php

namespace App\Repositories;

use App\Models\ProjectTopicSection;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTopicSectionRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:45 pm UTC
 *
 * @method ProjectTopicSection findWithoutFail($id, $columns = ['*'])
 * @method ProjectTopicSection find($id, $columns = ['*'])
 * @method ProjectTopicSection first($columns = ['*'])
*/
class ProjectTopicSectionRepository extends BaseRepository
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
        'project_topic_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTopicSection::class;
    }
}
