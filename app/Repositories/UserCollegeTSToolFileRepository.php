<?php

namespace App\Repositories;

use App\Models\UserCollegeTSToolFile;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTSToolFileRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:47 pm UTC
 *
 * @method UserCollegeTSToolFile findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTSToolFile find($id, $columns = ['*'])
 * @method UserCollegeTSToolFile first($columns = ['*'])
*/
class UserCollegeTSToolFileRepository extends BaseRepository
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
        'college_t_s_t_file_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserCollegeTSToolFile::class;
    }
}
