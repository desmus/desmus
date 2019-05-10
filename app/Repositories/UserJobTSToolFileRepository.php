<?php

namespace App\Repositories;

use App\Models\UserJobTSToolFile;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTSToolFileRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:47 pm UTC
 *
 * @method UserJobTSToolFile findWithoutFail($id, $columns = ['*'])
 * @method UserJobTSToolFile find($id, $columns = ['*'])
 * @method UserJobTSToolFile first($columns = ['*'])
*/
class UserJobTSToolFileRepository extends BaseRepository
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
        'job_t_s_t_file_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserJobTSToolFile::class;
    }
}
