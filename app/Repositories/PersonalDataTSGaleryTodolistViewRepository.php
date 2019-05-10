<?php

namespace App\Repositories;

use App\Models\PersonalDataTSGaleryTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSGaleryTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:12 am UTC
 *
 * @method PersonalDataTSGaleryTodolistView findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSGaleryTodolistView find($id, $columns = ['*'])
 * @method PersonalDataTSGaleryTodolistView first($columns = ['*'])
*/
class PersonalDataTSGaleryTodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_d_t_s_g_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSGaleryTodolistView::class;
    }
}
