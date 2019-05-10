<?php

namespace App\Repositories;

use App\Models\CollegeTSGaleryView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSGaleryViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:50 pm UTC
 *
 * @method CollegeTSGaleryView findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSGaleryView find($id, $columns = ['*'])
 * @method CollegeTSGaleryView first($columns = ['*'])
*/
class CollegeTSGaleryViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'college_t_s_galery_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSGaleryView::class;
    }
}
