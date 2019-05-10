<?php

namespace App\Repositories;

use App\Models\ProjectTSToolFileDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSToolFileDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:56 pm UTC
 *
 * @method ProjectTSToolFileDelete findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSToolFileDelete find($id, $columns = ['*'])
 * @method ProjectTSToolFileDelete first($columns = ['*'])
*/
class ProjectTSToolFileDeleteRepository extends BaseRepository
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
        return ProjectTSToolFileDelete::class;
    }
}
