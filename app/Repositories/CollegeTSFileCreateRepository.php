<?php

namespace App\Repositories;

use App\Models\CollegeTSFileCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSFileCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:48 pm UTC
 *
 * @method CollegeTSFileCreate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSFileCreate find($id, $columns = ['*'])
 * @method CollegeTSFileCreate first($columns = ['*'])
*/
class CollegeTSFileCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'college_t_s_file_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSFileCreate::class;
    }
}
