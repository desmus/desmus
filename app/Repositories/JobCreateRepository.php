<?php

namespace App\Repositories;

use App\Models\JobCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:47 pm UTC
 *
 * @method JobCreate findWithoutFail($id, $columns = ['*'])
 * @method JobCreate find($id, $columns = ['*'])
 * @method JobCreate first($columns = ['*'])
*/
class JobCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'job_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobCreate::class;
    }
}
