<?php

namespace App\Repositories;

use App\Models\JobTSGaleryImageCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSGaleryImageCreateRepository
 * @package App\Repositories
 * @version May 19, 2018, 8:44 pm UTC
 *
 * @method JobTSGaleryImageCreate findWithoutFail($id, $columns = ['*'])
 * @method JobTSGaleryImageCreate find($id, $columns = ['*'])
 * @method JobTSGaleryImageCreate first($columns = ['*'])
*/
class JobTSGaleryImageCreateRepository extends BaseRepository
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
        return JobTSGaleryImageCreate::class;
    }
}
