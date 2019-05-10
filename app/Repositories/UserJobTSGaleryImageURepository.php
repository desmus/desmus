<?php

namespace App\Repositories;

use App\Models\UserJobTSGaleryImageU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTSGaleryImageURepository
 * @package App\Repositories
 * @version June 18, 2018, 9:01 pm UTC
 *
 * @method UserJobTSGaleryImageU findWithoutFail($id, $columns = ['*'])
 * @method UserJobTSGaleryImageU find($id, $columns = ['*'])
 * @method UserJobTSGaleryImageU first($columns = ['*'])
*/
class UserJobTSGaleryImageURepository extends BaseRepository
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
        return UserJobTSGaleryImageU::class;
    }
}
