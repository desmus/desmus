<?php

namespace App\Repositories;

use App\Models\ProjectTSFileCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSFileCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:48 pm UTC
 *
 * @method ProjectTSFileCreate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSFileCreate find($id, $columns = ['*'])
 * @method ProjectTSFileCreate first($columns = ['*'])
*/
class ProjectTSFileCreateRepository extends BaseRepository
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
        return ProjectTSFileCreate::class;
    }
}
