<?php

namespace App\Repositories;

use App\Models\UserCollegeTSFile;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTSFileRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:46 pm UTC
 *
 * @method UserCollegeTSFile findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTSFile find($id, $columns = ['*'])
 * @method UserCollegeTSFile first($columns = ['*'])
*/
class UserCollegeTSFileRepository extends BaseRepository
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
        'college_t_s_file_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserCollegeTSFile::class;
    }
}
