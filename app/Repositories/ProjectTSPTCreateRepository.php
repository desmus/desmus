<?php

namespace App\Repositories;

use App\Models\ProjectTSPTCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSPTCreateRepository
 * @package App\Repositories
 * @version July 2, 2018, 3:35 am UTC
 *
 * @method ProjectTSPTCreate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSPTCreate find($id, $columns = ['*'])
 * @method ProjectTSPTCreate first($columns = ['*'])
*/
class ProjectTSPTCreateRepository extends BaseRepository
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
        return ProjectTSPTCreate::class;
    }
}
