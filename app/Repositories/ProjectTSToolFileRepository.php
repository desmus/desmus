<?php

namespace App\Repositories;

use App\Models\ProjectTSToolFile;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSToolFileRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:46 pm UTC
 *
 * @method ProjectTSToolFile findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSToolFile find($id, $columns = ['*'])
 * @method ProjectTSToolFile first($columns = ['*'])
*/
class ProjectTSToolFileRepository extends BaseRepository
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
        'project_t_s_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSToolFile::class;
    }
}
