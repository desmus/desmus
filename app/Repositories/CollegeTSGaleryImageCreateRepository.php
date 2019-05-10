<?php

namespace App\Repositories;

use App\Models\CollegeTSGaleryImageCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSGaleryImageCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:49 pm UTC
 *
 * @method CollegeTSGaleryImageCreate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSGaleryImageCreate find($id, $columns = ['*'])
 * @method CollegeTSGaleryImageCreate first($columns = ['*'])
*/
class CollegeTSGaleryImageCreateRepository extends BaseRepository
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
        return CollegeTSGaleryImageCreate::class;
    }
}
