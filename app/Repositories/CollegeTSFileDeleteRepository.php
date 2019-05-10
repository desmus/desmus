<?php

namespace App\Repositories;

use App\Models\CollegeTSFileDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSFileDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:54 pm UTC
 *
 * @method CollegeTSFileDelete findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSFileDelete find($id, $columns = ['*'])
 * @method CollegeTSFileDelete first($columns = ['*'])
*/
class CollegeTSFileDeleteRepository extends BaseRepository
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
        return CollegeTSFileDelete::class;
    }
}
