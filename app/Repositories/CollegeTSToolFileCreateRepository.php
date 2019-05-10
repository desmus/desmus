<?php

namespace App\Repositories;

use App\Models\CollegeTSToolFileCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSToolFileCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:49 pm UTC
 *
 * @method CollegeTSToolFileCreate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSToolFileCreate find($id, $columns = ['*'])
 * @method CollegeTSToolFileCreate first($columns = ['*'])
*/
class CollegeTSToolFileCreateRepository extends BaseRepository
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
        return CollegeTSToolFileCreate::class;
    }
}
