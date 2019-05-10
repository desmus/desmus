<?php

namespace App\Repositories;

use App\Models\ProjectTSGaleryCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSGaleryCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:48 pm UTC
 *
 * @method ProjectTSGaleryCreate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSGaleryCreate find($id, $columns = ['*'])
 * @method ProjectTSGaleryCreate first($columns = ['*'])
*/
class ProjectTSGaleryCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'project_t_s_galery_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSGaleryCreate::class;
    }
}
