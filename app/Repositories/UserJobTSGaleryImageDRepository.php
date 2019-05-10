<?php

namespace App\Repositories;

use App\Models\UserJobTSGaleryImageD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTSGaleryImageDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:07 pm UTC
 *
 * @method UserJobTSGaleryImageD findWithoutFail($id, $columns = ['*'])
 * @method UserJobTSGaleryImageD find($id, $columns = ['*'])
 * @method UserJobTSGaleryImageD first($columns = ['*'])
*/
class UserJobTSGaleryImageDRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_j_t_s_g_i_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserJobTSGaleryImageD::class;
    }
}
