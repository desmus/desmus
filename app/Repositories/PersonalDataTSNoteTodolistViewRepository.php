<?php

namespace App\Repositories;

use App\Models\PersonalDataTSNoteTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSNoteTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:12 am UTC
 *
 * @method PersonalDataTSNoteTodolistView findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSNoteTodolistView find($id, $columns = ['*'])
 * @method PersonalDataTSNoteTodolistView first($columns = ['*'])
*/
class PersonalDataTSNoteTodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_d_t_s_n_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSNoteTodolistView::class;
    }
}
