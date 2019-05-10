<?php

namespace App\Repositories;

use App\Models\JobTSGaleryImageView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSGaleryImageViewRepository
 * @package App\Repositories
 * @version May 19, 2018, 8:44 pm UTC
 *
 * @method JobTSGaleryImageView findWithoutFail($id, $columns = ['*'])
 * @method JobTSGaleryImageView find($id, $columns = ['*'])
 * @method JobTSGaleryImageView first($columns = ['*'])
*/
class JobTSGaleryImageViewRepository extends BaseRepository
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
        return JobTSGaleryImageView::class;
    }
}
