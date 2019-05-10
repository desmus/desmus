<?php

namespace App\Repositories;

use App\Models\JobTSPTView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSPTViewRepository
 * @package App\Repositories
 * @version July 2, 2018, 3:35 am UTC
 *
 * @method JobTSPTView findWithoutFail($id, $columns = ['*'])
 * @method JobTSPTView find($id, $columns = ['*'])
 * @method JobTSPTView first($columns = ['*'])
*/
class JobTSPTViewRepository extends BaseRepository
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
        return JobTSPTView::class;
    }
}
