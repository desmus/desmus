<?php

namespace App\Repositories;

use App\Models\JobTSGaleryImageUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSGaleryImageUpdateRepository
 * @package App\Repositories
 * @version May 19, 2018, 8:44 pm UTC
 *
 * @method JobTSGaleryImageUpdate findWithoutFail($id, $columns = ['*'])
 * @method JobTSGaleryImageUpdate find($id, $columns = ['*'])
 * @method JobTSGaleryImageUpdate first($columns = ['*'])
*/
class JobTSGaleryImageUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'job_t_s_g_image_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSGaleryImageUpdate::class;
    }
}
