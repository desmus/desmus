<?php

namespace App\Repositories;

use App\Models\ProjectTSFile;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSFileRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:45 pm UTC
 *
 * @method ProjectTSFile findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSFile find($id, $columns = ['*'])
 * @method ProjectTSFile first($columns = ['*'])
*/
class ProjectTSFileRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'file_type',
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
        return ProjectTSFile::class;
    }
}
