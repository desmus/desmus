<?php

namespace App\Repositories;

use App\Models\UserJobTSFile;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTSFileRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:46 pm UTC
 *
 * @method UserJobTSFile findWithoutFail($id, $columns = ['*'])
 * @method UserJobTSFile find($id, $columns = ['*'])
 * @method UserJobTSFile first($columns = ['*'])
*/
class UserJobTSFileRepository extends BaseRepository
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
        'job_t_s_file_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserJobTSFile::class;
    }
}
