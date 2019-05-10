<?php

namespace App\Repositories;

use App\Models\ProjectTSToolFileCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSToolFileCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:49 pm UTC
 *
 * @method ProjectTSToolFileCreate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSToolFileCreate find($id, $columns = ['*'])
 * @method ProjectTSToolFileCreate first($columns = ['*'])
*/
class ProjectTSToolFileCreateRepository extends BaseRepository
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
        return ProjectTSToolFileCreate::class;
    }
}
