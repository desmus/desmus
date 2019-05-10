<?php

namespace App\Repositories;

use App\Models\UserProjectTSGaleryImageU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTSGaleryImageURepository
 * @package App\Repositories
 * @version June 18, 2018, 9:01 pm UTC
 *
 * @method UserProjectTSGaleryImageU findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTSGaleryImageU find($id, $columns = ['*'])
 * @method UserProjectTSGaleryImageU first($columns = ['*'])
*/
class UserProjectTSGaleryImageURepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_p_t_s_g_i_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserProjectTSGaleryImageU::class;
    }
}
