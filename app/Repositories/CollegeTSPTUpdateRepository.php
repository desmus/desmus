<?php

namespace App\Repositories;

use App\Models\CollegeTSPTUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSPTUpdateRepository
 * @package App\Repositories
 * @version July 2, 2018, 3:35 am UTC
 *
 * @method CollegeTSPTUpdate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSPTUpdate find($id, $columns = ['*'])
 * @method CollegeTSPTUpdate first($columns = ['*'])
*/
class CollegeTSPTUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'c_t_s_p_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSPTUpdate::class;
    }
}
