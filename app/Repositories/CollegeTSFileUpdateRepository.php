<?php

namespace App\Repositories;

use App\Models\CollegeTSFileUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSFileUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:51 pm UTC
 *
 * @method CollegeTSFileUpdate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSFileUpdate find($id, $columns = ['*'])
 * @method CollegeTSFileUpdate first($columns = ['*'])
*/
class CollegeTSFileUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'college_t_s_file_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSFileUpdate::class;
    }
}
