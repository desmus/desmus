<?php

namespace App\Repositories;

use App\Models\CollegeTSToolFileDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSToolFileDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:56 pm UTC
 *
 * @method CollegeTSToolFileDelete findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSToolFileDelete find($id, $columns = ['*'])
 * @method CollegeTSToolFileDelete first($columns = ['*'])
*/
class CollegeTSToolFileDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'college_t_s_t_file_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSToolFileDelete::class;
    }
}
