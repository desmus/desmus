<?php

namespace App\Repositories;

use App\Models\PersonalDataTSGITodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSGITodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:13 am UTC
 *
 * @method PersonalDataTSGITodolistView findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSGITodolistView find($id, $columns = ['*'])
 * @method PersonalDataTSGITodolistView first($columns = ['*'])
*/
class PersonalDataTSGITodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_d_t_s_g_i_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSGITodolistView::class;
    }
}
