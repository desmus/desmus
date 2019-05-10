<?php

namespace App\Repositories;

use App\Models\ProjectTSPTView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSPTViewRepository
 * @package App\Repositories
 * @version July 2, 2018, 3:35 am UTC
 *
 * @method ProjectTSPTView findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSPTView find($id, $columns = ['*'])
 * @method ProjectTSPTView first($columns = ['*'])
*/
class ProjectTSPTViewRepository extends BaseRepository
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
        return ProjectTSPTView::class;
    }
}
