<?php

namespace App\Repositories;

use App\Models\UserProjectTSGaleryImageC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTSGaleryImageCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:55 pm UTC
 *
 * @method UserProjectTSGaleryImageC findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTSGaleryImageC find($id, $columns = ['*'])
 * @method UserProjectTSGaleryImageC first($columns = ['*'])
*/
class UserProjectTSGaleryImageCRepository extends BaseRepository
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
        return UserProjectTSGaleryImageC::class;
    }
}
