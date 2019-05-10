<?php

namespace App\Repositories;

use App\Models\ProjectTSPTUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSPTUpdateRepository
 * @package App\Repositories
 * @version July 2, 2018, 3:36 am UTC
 *
 * @method ProjectTSPTUpdate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSPTUpdate find($id, $columns = ['*'])
 * @method ProjectTSPTUpdate first($columns = ['*'])
*/
class ProjectTSPTUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'p_t_s_p_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSPTUpdate::class;
    }
}
