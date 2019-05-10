<?php

namespace App\Repositories;

use App\Models\SharedProfileFileView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SharedProfileFileViewRepository
 * @package App\Repositories
 * @version April 11, 2019, 3:29 pm UTC
 *
 * @method SharedProfileFileView findWithoutFail($id, $columns = ['*'])
 * @method SharedProfileFileView find($id, $columns = ['*'])
 * @method SharedProfileFileView first($columns = ['*'])
*/
class SharedProfileFileViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        's_p_f_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SharedProfileFileView::class;
    }
}
