<?php

namespace App\Repositories;

use App\Models\UserProjectTSToolFile;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTSToolFileRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:47 pm UTC
 *
 * @method UserProjectTSToolFile findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTSToolFile find($id, $columns = ['*'])
 * @method UserProjectTSToolFile first($columns = ['*'])
*/
class UserProjectTSToolFileRepository extends BaseRepository
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
        'project_t_s_t_file_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserProjectTSToolFile::class;
    }
}
