<?php

namespace App\Repositories;

use App\Models\ProjectTSGaleryImageCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSGaleryImageCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:49 pm UTC
 *
 * @method ProjectTSGaleryImageCreate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSGaleryImageCreate find($id, $columns = ['*'])
 * @method ProjectTSGaleryImageCreate first($columns = ['*'])
*/
class ProjectTSGaleryImageCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'project_t_s_g_image_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSGaleryImageCreate::class;
    }
}
