<?php

namespace App\Repositories;

use App\Models\UserProject;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:46 pm UTC
 *
 * @method UserProject findWithoutFail($id, $columns = ['*'])
 * @method UserProject find($id, $columns = ['*'])
 * @method UserProject first($columns = ['*'])
*/
class UserProjectRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'description',
        'status',
        'permissions',
        'user_id',
        'project_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserProject::class;
    }
}
