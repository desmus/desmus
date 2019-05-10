<?php

namespace App\Repositories;

use App\Models\UserJobTSGaleryImageC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTSGaleryImageCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:55 pm UTC
 *
 * @method UserJobTSGaleryImageC findWithoutFail($id, $columns = ['*'])
 * @method UserJobTSGaleryImageC find($id, $columns = ['*'])
 * @method UserJobTSGaleryImageC first($columns = ['*'])
*/
class UserJobTSGaleryImageCRepository extends BaseRepository
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
        return UserJobTSGaleryImageC::class;
    }
}
