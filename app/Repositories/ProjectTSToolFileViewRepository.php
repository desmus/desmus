<?php

namespace App\Repositories;

use App\Models\ProjectTSToolFileView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSToolFileViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:50 pm UTC
 *
 * @method ProjectTSToolFileView findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSToolFileView find($id, $columns = ['*'])
 * @method ProjectTSToolFileView first($columns = ['*'])
*/
class ProjectTSToolFileViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'project_t_s_t_file_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSToolFileView::class;
    }
}
