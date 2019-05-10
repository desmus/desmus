<?php

namespace App\Repositories;

use App\Models\ProjectTopicSectionDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTopicSectionDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:54 pm UTC
 *
 * @method ProjectTopicSectionDelete findWithoutFail($id, $columns = ['*'])
 * @method ProjectTopicSectionDelete find($id, $columns = ['*'])
 * @method ProjectTopicSectionDelete first($columns = ['*'])
*/
class ProjectTopicSectionDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'project_topic_section_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTopicSectionDelete::class;
    }
}
