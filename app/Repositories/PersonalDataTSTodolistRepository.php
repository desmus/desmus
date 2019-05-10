<?php

namespace App\Repositories;

use App\Models\PersonalDataTSTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:34 am UTC
 *
 * @method PersonalDataTSTodolist findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSTodolist find($id, $columns = ['*'])
 * @method PersonalDataTSTodolist first($columns = ['*'])
*/
class PersonalDataTSTodolistRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'views_quantity',
        'updates_quantity',
        'status',
        'datetime',
        'p_d_t_s_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSTodolist::class;
    }
}
