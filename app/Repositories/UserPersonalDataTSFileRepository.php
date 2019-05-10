<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTSFile;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTSFileRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:47 pm UTC
 *
 * @method UserPersonalDataTSFile findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTSFile find($id, $columns = ['*'])
 * @method UserPersonalDataTSFile first($columns = ['*'])
*/
class UserPersonalDataTSFileRepository extends BaseRepository
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
        'personal_data_t_s_file_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserPersonalDataTSFile::class;
    }
}
