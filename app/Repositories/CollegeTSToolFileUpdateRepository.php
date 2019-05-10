<?php

namespace App\Repositories;

use App\Models\CollegeTSToolFileUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSToolFileUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:52 pm UTC
 *
 * @method CollegeTSToolFileUpdate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSToolFileUpdate find($id, $columns = ['*'])
 * @method CollegeTSToolFileUpdate first($columns = ['*'])
*/
class CollegeTSToolFileUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'college_t_s_t_file_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSToolFileUpdate::class;
    }
}
