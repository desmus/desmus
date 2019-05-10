<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTSToolFile;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTSToolFileRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:47 pm UTC
 *
 * @method UserPersonalDataTSToolFile findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTSToolFile find($id, $columns = ['*'])
 * @method UserPersonalDataTSToolFile first($columns = ['*'])
*/
class UserPersonalDataTSToolFileRepository extends BaseRepository
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
        'personal_d_t_s_t_f_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserPersonalDataTSToolFile::class;
    }
}
