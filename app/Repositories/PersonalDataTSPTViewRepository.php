<?php

namespace App\Repositories;

use App\Models\PersonalDataTSPTView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSPTViewRepository
 * @package App\Repositories
 * @version July 2, 2018, 3:36 am UTC
 *
 * @method PersonalDataTSPTView findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSPTView find($id, $columns = ['*'])
 * @method PersonalDataTSPTView first($columns = ['*'])
*/
class PersonalDataTSPTViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_d_t_s_p_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSPTView::class;
    }
}
