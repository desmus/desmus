<?php

namespace App\Repositories;

use App\Models\PersonalDataTSTFTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSTFTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:13 am UTC
 *
 * @method PersonalDataTSTFTodolistView findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSTFTodolistView find($id, $columns = ['*'])
 * @method PersonalDataTSTFTodolistView first($columns = ['*'])
*/
class PersonalDataTSTFTodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_d_t_s_t_f_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSTFTodolistView::class;
    }
}
