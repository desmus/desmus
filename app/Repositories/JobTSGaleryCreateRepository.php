<?php

namespace App\Repositories;

use App\Models\JobTSGaleryCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSGaleryCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:48 pm UTC
 *
 * @method JobTSGaleryCreate findWithoutFail($id, $columns = ['*'])
 * @method JobTSGaleryCreate find($id, $columns = ['*'])
 * @method JobTSGaleryCreate first($columns = ['*'])
*/
class JobTSGaleryCreateRepository extends BaseRepository
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
        return JobTSGaleryCreate::class;
    }
}
