<?php

namespace App\Repositories;

use App\Models\JobTSFileView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSFileViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:49 pm UTC
 *
 * @method JobTSFileView findWithoutFail($id, $columns = ['*'])
 * @method JobTSFileView find($id, $columns = ['*'])
 * @method JobTSFileView first($columns = ['*'])
*/
class JobTSFileViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'job_t_s_file_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSFileView::class;
    }
}
