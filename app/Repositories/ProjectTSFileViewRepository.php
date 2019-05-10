<?php

namespace App\Repositories;

use App\Models\ProjectTSFileView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSFileViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:49 pm UTC
 *
 * @method ProjectTSFileView findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSFileView find($id, $columns = ['*'])
 * @method ProjectTSFileView first($columns = ['*'])
*/
class ProjectTSFileViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'project_t_s_file_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSFileView::class;
    }
}
