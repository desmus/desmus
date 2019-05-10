<?php

namespace App\Repositories;

use App\Models\CollegeTSGaleryCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSGaleryCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:48 pm UTC
 *
 * @method CollegeTSGaleryCreate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSGaleryCreate find($id, $columns = ['*'])
 * @method CollegeTSGaleryCreate first($columns = ['*'])
*/
class CollegeTSGaleryCreateRepository extends BaseRepository
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
        return CollegeTSGaleryCreate::class;
    }
}
