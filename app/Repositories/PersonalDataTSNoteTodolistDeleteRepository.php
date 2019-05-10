<?php

namespace App\Repositories;

use App\Models\PersonalDataTSNoteTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSNoteTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:16 am UTC
 *
 * @method PersonalDataTSNoteTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSNoteTodolistDelete find($id, $columns = ['*'])
 * @method PersonalDataTSNoteTodolistDelete first($columns = ['*'])
*/
class PersonalDataTSNoteTodolistDeleteRepository extends BaseRepository
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
        return PersonalDataTSNoteTodolistDelete::class;
    }
}
