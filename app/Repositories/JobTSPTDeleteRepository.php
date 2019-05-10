<?php

namespace App\Repositories;

use App\Models\JobTSPTDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSPTDeleteRepository
 * @package App\Repositories
 * @version July 2, 2018, 3:35 am UTC
 *
 * @method JobTSPTDelete findWithoutFail($id, $columns = ['*'])
 * @method JobTSPTDelete find($id, $columns = ['*'])
 * @method JobTSPTDelete first($columns = ['*'])
*/
class JobTSPTDeleteRepository extends BaseRepository
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
        return JobTSPTDelete::class;
    }
}
