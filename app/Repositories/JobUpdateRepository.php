<?php

namespace App\Repositories;

use App\Models\JobUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:50 pm UTC
 *
 * @method JobUpdate findWithoutFail($id, $columns = ['*'])
 * @method JobUpdate find($id, $columns = ['*'])
 * @method JobUpdate first($columns = ['*'])
*/
class JobUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'job_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobUpdate::class;
    }
}
