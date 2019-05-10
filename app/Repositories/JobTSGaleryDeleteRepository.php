<?php

namespace App\Repositories;

use App\Models\JobTSGaleryDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSGaleryDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:55 pm UTC
 *
 * @method JobTSGaleryDelete findWithoutFail($id, $columns = ['*'])
 * @method JobTSGaleryDelete find($id, $columns = ['*'])
 * @method JobTSGaleryDelete first($columns = ['*'])
*/
class JobTSGaleryDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'job_t_s_galery_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSGaleryDelete::class;
    }
}
