<?php

namespace App\Repositories;

use App\Models\JobTSPTCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSPTCreateRepository
 * @package App\Repositories
 * @version July 2, 2018, 3:35 am UTC
 *
 * @method JobTSPTCreate findWithoutFail($id, $columns = ['*'])
 * @method JobTSPTCreate find($id, $columns = ['*'])
 * @method JobTSPTCreate first($columns = ['*'])
*/
class JobTSPTCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'j_t_s_p_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSPTCreate::class;
    }
}
