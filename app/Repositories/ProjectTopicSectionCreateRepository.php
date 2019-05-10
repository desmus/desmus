<?php

namespace App\Repositories;

use App\Models\ProjectTopicSectionCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTopicSectionCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:48 pm UTC
 *
 * @method ProjectTopicSectionCreate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTopicSectionCreate find($id, $columns = ['*'])
 * @method ProjectTopicSectionCreate first($columns = ['*'])
*/
class ProjectTopicSectionCreateRepository extends BaseRepository
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
        return ProjectTopicSectionCreate::class;
    }
}
