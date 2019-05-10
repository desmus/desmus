<?php

namespace App\Repositories;

use App\Models\CollegeTSPTDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSPTDeleteRepository
 * @package App\Repositories
 * @version July 2, 2018, 3:35 am UTC
 *
 * @method CollegeTSPTDelete findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSPTDelete find($id, $columns = ['*'])
 * @method CollegeTSPTDelete first($columns = ['*'])
*/
class CollegeTSPTDeleteRepository extends BaseRepository
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
        return CollegeTSPTDelete::class;
    }
}
