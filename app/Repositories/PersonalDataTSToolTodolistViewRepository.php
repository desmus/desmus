<?php

namespace App\Repositories;

use App\Models\PersonalDataTSToolTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSToolTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:12 am UTC
 *
 * @method PersonalDataTSToolTodolistView findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSToolTodolistView find($id, $columns = ['*'])
 * @method PersonalDataTSToolTodolistView first($columns = ['*'])
*/
class PersonalDataTSToolTodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_d_t_s_t_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSToolTodolistView::class;
    }
}
