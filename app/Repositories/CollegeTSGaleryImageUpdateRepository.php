<?php

namespace App\Repositories;

use App\Models\CollegeTSGaleryImageUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSGaleryImageUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:52 pm UTC
 *
 * @method CollegeTSGaleryImageUpdate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSGaleryImageUpdate find($id, $columns = ['*'])
 * @method CollegeTSGaleryImageUpdate first($columns = ['*'])
*/
class CollegeTSGaleryImageUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'college_t_s_g_image_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSGaleryImageUpdate::class;
    }
}
