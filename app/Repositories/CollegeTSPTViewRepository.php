<?php

namespace App\Repositories;

use App\Models\CollegeTSPTView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSPTViewRepository
 * @package App\Repositories
 * @version July 2, 2018, 3:34 am UTC
 *
 * @method CollegeTSPTView findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSPTView find($id, $columns = ['*'])
 * @method CollegeTSPTView first($columns = ['*'])
*/
class CollegeTSPTViewRepository extends BaseRepository
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
        return CollegeTSPTView::class;
    }
}
