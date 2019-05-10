<?php

namespace App\Repositories;

use App\Models\ProjectTSPTDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSPTDeleteRepository
 * @package App\Repositories
 * @version July 2, 2018, 3:36 am UTC
 *
 * @method ProjectTSPTDelete findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSPTDelete find($id, $columns = ['*'])
 * @method ProjectTSPTDelete first($columns = ['*'])
*/
class ProjectTSPTDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_t_s_p_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSPTDelete::class;
    }
}
