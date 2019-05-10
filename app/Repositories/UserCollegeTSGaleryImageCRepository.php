<?php

namespace App\Repositories;

use App\Models\UserCollegeTSGaleryImageC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTSGaleryImageCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:55 pm UTC
 *
 * @method UserCollegeTSGaleryImageC findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTSGaleryImageC find($id, $columns = ['*'])
 * @method UserCollegeTSGaleryImageC first($columns = ['*'])
*/
class UserCollegeTSGaleryImageCRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_c_t_s_g_i_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserCollegeTSGaleryImageC::class;
    }
}
