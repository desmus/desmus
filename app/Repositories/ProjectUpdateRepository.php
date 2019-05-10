<?php

namespace App\Repositories;

use App\Models\ProjectUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:50 pm UTC
 *
 * @method ProjectUpdate findWithoutFail($id, $columns = ['*'])
 * @method ProjectUpdate find($id, $columns = ['*'])
 * @method ProjectUpdate first($columns = ['*'])
*/
class ProjectUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'project_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectUpdate::class;
    }
}
