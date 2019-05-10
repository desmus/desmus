<?php

namespace App\Repositories;

use App\Models\ProjectCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:47 pm UTC
 *
 * @method ProjectCreate findWithoutFail($id, $columns = ['*'])
 * @method ProjectCreate find($id, $columns = ['*'])
 * @method ProjectCreate first($columns = ['*'])
*/
class ProjectCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'project_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectCreate::class;
    }
}
