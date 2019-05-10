<?php

namespace App\Repositories;

use App\Models\CollegeTSPTCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSPTCreateRepository
 * @package App\Repositories
 * @version July 2, 2018, 3:34 am UTC
 *
 * @method CollegeTSPTCreate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSPTCreate find($id, $columns = ['*'])
 * @method CollegeTSPTCreate first($columns = ['*'])
*/
class CollegeTSPTCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'c_t_s_p_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSPTCreate::class;
    }
}
