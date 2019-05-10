<?php

namespace App\Repositories;

use App\Models\ProjectTopicSectionUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTopicSectionUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:51 pm UTC
 *
 * @method ProjectTopicSectionUpdate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTopicSectionUpdate find($id, $columns = ['*'])
 * @method ProjectTopicSectionUpdate first($columns = ['*'])
*/
class ProjectTopicSectionUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'project_topic_section_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTopicSectionUpdate::class;
    }
}
