<?php

namespace App\Repositories;

use App\Models\JobDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:53 pm UTC
 *
 * @method JobDelete findWithoutFail($id, $columns = ['*'])
 * @method JobDelete find($id, $columns = ['*'])
 * @method JobDelete first($columns = ['*'])
*/
class JobDeleteRepository extends BaseRepository
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
        return JobDelete::class;
    }
}
