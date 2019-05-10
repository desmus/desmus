<?php

namespace App\Repositories;

use App\Models\PersonalDataTSTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:11 am UTC
 *
 * @method PersonalDataTSTodolistView findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSTodolistView find($id, $columns = ['*'])
 * @method PersonalDataTSTodolistView first($columns = ['*'])
*/
class PersonalDataTSTodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_d_t_s_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSTodolistView::class;
    }
}
