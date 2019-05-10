<?php

namespace App\Repositories;

use App\Models\JobTSGaleryUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSGaleryUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:51 pm UTC
 *
 * @method JobTSGaleryUpdate findWithoutFail($id, $columns = ['*'])
 * @method JobTSGaleryUpdate find($id, $columns = ['*'])
 * @method JobTSGaleryUpdate first($columns = ['*'])
*/
class JobTSGaleryUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'job_t_s_galery_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSGaleryUpdate::class;
    }
}
