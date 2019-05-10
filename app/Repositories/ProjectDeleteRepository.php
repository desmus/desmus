<?php

namespace App\Repositories;

use App\Models\ProjectDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:53 pm UTC
 *
 * @method ProjectDelete findWithoutFail($id, $columns = ['*'])
 * @method ProjectDelete find($id, $columns = ['*'])
 * @method ProjectDelete first($columns = ['*'])
*/
class ProjectDeleteRepository extends BaseRepository
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
        return ProjectDelete::class;
    }
}
