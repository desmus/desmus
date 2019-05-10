<?php

namespace App\Repositories;

use App\Models\CollegeTSGaleryImageView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSGaleryImageViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:50 pm UTC
 *
 * @method CollegeTSGaleryImageView findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSGaleryImageView find($id, $columns = ['*'])
 * @method CollegeTSGaleryImageView first($columns = ['*'])
*/
class CollegeTSGaleryImageViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'college_t_s_g_image_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSGaleryImageView::class;
    }
}
