<?php

namespace App\Repositories;

use App\Models\JobTSPTUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSPTUpdateRepository
 * @package App\Repositories
 * @version July 2, 2018, 3:35 am UTC
 *
 * @method JobTSPTUpdate findWithoutFail($id, $columns = ['*'])
 * @method JobTSPTUpdate find($id, $columns = ['*'])
 * @method JobTSPTUpdate first($columns = ['*'])
*/
class JobTSPTUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'j_t_s_p_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSPTUpdate::class;
    }
}
