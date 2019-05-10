<?php

namespace App\Repositories;

use App\Models\CollegeTSFileView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSFileViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:49 pm UTC
 *
 * @method CollegeTSFileView findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSFileView find($id, $columns = ['*'])
 * @method CollegeTSFileView first($columns = ['*'])
*/
class CollegeTSFileViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'college_t_s_file_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSFileView::class;
    }
}
