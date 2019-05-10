<?php

namespace App\Repositories;

use App\Models\ProjectTSFileDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSFileDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:54 pm UTC
 *
 * @method ProjectTSFileDelete findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSFileDelete find($id, $columns = ['*'])
 * @method ProjectTSFileDelete first($columns = ['*'])
*/
class ProjectTSFileDeleteRepository extends BaseRepository
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
        return ProjectTSFileDelete::class;
    }
}
