<?php

namespace App\Repositories;

use App\Models\ProjectTSNote;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSNoteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:45 pm UTC
 *
 * @method ProjectTSNote findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSNote find($id, $columns = ['*'])
 * @method ProjectTSNote first($columns = ['*'])
*/
class ProjectTSNoteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'content',
        'views_quantity',
        'updates_quantity',
        'status',
        'project_topic_section_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSNote::class;
    }
}
