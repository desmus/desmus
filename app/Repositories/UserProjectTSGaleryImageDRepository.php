<?php

namespace App\Repositories;

use App\Models\UserProjectTSGaleryImageD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTSGaleryImageDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:07 pm UTC
 *
 * @method UserProjectTSGaleryImageD findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTSGaleryImageD find($id, $columns = ['*'])
 * @method UserProjectTSGaleryImageD first($columns = ['*'])
*/
class UserProjectTSGaleryImageDRepository extends BaseRepository
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
        return UserProjectTSGaleryImageD::class;
    }
}
