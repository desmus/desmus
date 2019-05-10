<?php

namespace App\Repositories;

use App\Models\JobView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:49 pm UTC
 *
 * @method JobView findWithoutFail($id, $columns = ['*'])
 * @method JobView find($id, $columns = ['*'])
 * @method JobView first($columns = ['*'])
*/
class JobViewRepository extends BaseRepository
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
        return JobView::class;
    }
}
