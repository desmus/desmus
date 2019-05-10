<?php

namespace App\Repositories;

use App\Models\UserJob;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:46 pm UTC
 *
 * @method UserJob findWithoutFail($id, $columns = ['*'])
 * @method UserJob find($id, $columns = ['*'])
 * @method UserJob first($columns = ['*'])
*/
class UserJobRepository extends BaseRepository
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
        'job_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserJob::class;
    }
}
