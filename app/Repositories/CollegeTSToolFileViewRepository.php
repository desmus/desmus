<?php

namespace App\Repositories;

use App\Models\CollegeTSToolFileView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSToolFileViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:50 pm UTC
 *
 * @method CollegeTSToolFileView findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSToolFileView find($id, $columns = ['*'])
 * @method CollegeTSToolFileView first($columns = ['*'])
*/
class CollegeTSToolFileViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'college_t_s_t_file_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSToolFileView::class;
    }
}
