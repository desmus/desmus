<?php

namespace App\Repositories;

use App\Models\CollegeTSGaleryImageDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSGaleryImageDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:56 pm UTC
 *
 * @method CollegeTSGaleryImageDelete findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSGaleryImageDelete find($id, $columns = ['*'])
 * @method CollegeTSGaleryImageDelete first($columns = ['*'])
*/
class CollegeTSGaleryImageDeleteRepository extends BaseRepository
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
        return CollegeTSGaleryImageDelete::class;
    }
}
