<?php

namespace App\Repositories;

use App\Models\JobTSGaleryView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSGaleryViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:50 pm UTC
 *
 * @method JobTSGaleryView findWithoutFail($id, $columns = ['*'])
 * @method JobTSGaleryView find($id, $columns = ['*'])
 * @method JobTSGaleryView first($columns = ['*'])
*/
class JobTSGaleryViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'job_t_s_galery_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSGaleryView::class;
    }
}
