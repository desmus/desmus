<?php

namespace App\Repositories;

use App\Models\UserProjectTSGalerie;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTSGalerieRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:47 pm UTC
 *
 * @method UserProjectTSGalerie findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTSGalerie find($id, $columns = ['*'])
 * @method UserProjectTSGalerie first($columns = ['*'])
*/
class UserProjectTSGalerieRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'description',
        'status',
        'permissions',
        'user_id',
        'project_t_s_galery_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserProjectTSGalerie::class;
    }
}
