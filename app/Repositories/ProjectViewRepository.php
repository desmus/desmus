<?php

namespace App\Repositories;

use App\Models\ProjectView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:49 pm UTC
 *
 * @method ProjectView findWithoutFail($id, $columns = ['*'])
 * @method ProjectView find($id, $columns = ['*'])
 * @method ProjectView first($columns = ['*'])
*/
class ProjectViewRepository extends BaseRepository
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
        return ProjectView::class;
    }
}
