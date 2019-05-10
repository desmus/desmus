<?php

namespace App\Repositories;

use App\Models\UserProjectTSFile;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTSFileRepository
 * @package App\Repositories
 * @version November 8, 2018, 6:17 am UTC
 *
 * @method UserProjectTSFile findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTSFile find($id, $columns = ['*'])
 * @method UserProjectTSFile first($columns = ['*'])
*/
class UserProjectTSFileRepository extends BaseRepository
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
        'project_t_s_file_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserProjectTSFile::class;
    }
}
