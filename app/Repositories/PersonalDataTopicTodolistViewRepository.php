<?php

namespace App\Repositories;

use App\Models\PersonalDataTopicTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTopicTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:11 am UTC
 *
 * @method PersonalDataTopicTodolistView findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTopicTodolistView find($id, $columns = ['*'])
 * @method PersonalDataTopicTodolistView first($columns = ['*'])
*/
class PersonalDataTopicTodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_d_t_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTopicTodolistView::class;
    }
}
