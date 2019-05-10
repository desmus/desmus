<?php

namespace App\Repositories;

use App\Models\PersonalDataTSNoteTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSNoteTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:08 am UTC
 *
 * @method PersonalDataTSNoteTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSNoteTodolistCreate find($id, $columns = ['*'])
 * @method PersonalDataTSNoteTodolistCreate first($columns = ['*'])
*/
class PersonalDataTSNoteTodolistCreateRepository extends BaseRepository
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
        return PersonalDataTSNoteTodolistCreate::class;
    }
}
