<?php

namespace App\Repositories;

use App\Models\PersonalDataTSFileView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSFileViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:49 pm UTC
 *
 * @method PersonalDataTSFileView findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSFileView find($id, $columns = ['*'])
 * @method PersonalDataTSFileView first($columns = ['*'])
*/
class PersonalDataTSFileViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'personal_data_t_s_file_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSFileView::class;
    }
}
