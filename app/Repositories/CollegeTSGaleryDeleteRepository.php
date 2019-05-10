<?php

namespace App\Repositories;

use App\Models\CollegeTSGaleryDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSGaleryDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:55 pm UTC
 *
 * @method CollegeTSGaleryDelete findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSGaleryDelete find($id, $columns = ['*'])
 * @method CollegeTSGaleryDelete first($columns = ['*'])
*/
class CollegeTSGaleryDeleteRepository extends BaseRepository
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
        return CollegeTSGaleryDelete::class;
    }
}
