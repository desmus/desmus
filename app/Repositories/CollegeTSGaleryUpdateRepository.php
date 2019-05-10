<?php

namespace App\Repositories;

use App\Models\CollegeTSGaleryUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSGaleryUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:51 pm UTC
 *
 * @method CollegeTSGaleryUpdate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSGaleryUpdate find($id, $columns = ['*'])
 * @method CollegeTSGaleryUpdate first($columns = ['*'])
*/
class CollegeTSGaleryUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'college_t_s_galery_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSGaleryUpdate::class;
    }
}
