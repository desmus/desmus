<?php

namespace App\Repositories;

use App\Models\PersonalDataTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:11 am UTC
 *
 * @method PersonalDataTodolistView findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTodolistView find($id, $columns = ['*'])
 * @method PersonalDataTodolistView first($columns = ['*'])
*/
class PersonalDataTodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_d_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTodolistView::class;
    }
}
