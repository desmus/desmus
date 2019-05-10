<?php

namespace App\Repositories;

use App\Models\CollegeTSGaleryImage;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSGaleryImageRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:46 pm UTC
 *
 * @method CollegeTSGaleryImage findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSGaleryImage find($id, $columns = ['*'])
 * @method CollegeTSGaleryImage first($columns = ['*'])
*/
class CollegeTSGaleryImageRepository extends BaseRepository
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
        'college_t_s_g_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSGaleryImage::class;
    }
}
