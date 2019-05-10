<?php

namespace App\Repositories;

use App\Models\JobTSGaleryImage;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSGaleryImageRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:46 pm UTC
 *
 * @method JobTSGaleryImage findWithoutFail($id, $columns = ['*'])
 * @method JobTSGaleryImage find($id, $columns = ['*'])
 * @method JobTSGaleryImage first($columns = ['*'])
*/
class JobTSGaleryImageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'file_type',
        'views_quantity',
        'updates_quantity',
        'status',
        'job_t_s_g_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSGaleryImage::class;
    }
}
