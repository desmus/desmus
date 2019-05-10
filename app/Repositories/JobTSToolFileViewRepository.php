<?php

namespace App\Repositories;

use App\Models\JobTSToolFileView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSToolFileViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:50 pm UTC
 *
 * @method JobTSToolFileView findWithoutFail($id, $columns = ['*'])
 * @method JobTSToolFileView find($id, $columns = ['*'])
 * @method JobTSToolFileView first($columns = ['*'])
*/
class JobTSToolFileViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'job_t_s_t_file_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSToolFileView::class;
    }
}
