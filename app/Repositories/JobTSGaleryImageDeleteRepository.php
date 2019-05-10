<?php

namespace App\Repositories;

use App\Models\JobTSGaleryImageDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSGaleryImageDeleteRepository
 * @package App\Repositories
 * @version May 19, 2018, 8:44 pm UTC
 *
 * @method JobTSGaleryImageDelete findWithoutFail($id, $columns = ['*'])
 * @method JobTSGaleryImageDelete find($id, $columns = ['*'])
 * @method JobTSGaleryImageDelete first($columns = ['*'])
*/
class JobTSGaleryImageDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'job_t_s_g_image_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSGaleryImageDelete::class;
    }
}
