<?php

namespace App\Repositories;

use App\Models\CollegeTSToolCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSToolCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:48 pm UTC
 *
 * @method CollegeTSToolCreate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSToolCreate find($id, $columns = ['*'])
 * @method CollegeTSToolCreate first($columns = ['*'])
*/
class CollegeTSToolCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'college_t_s_tool_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSToolCreate::class;
    }
}
