<?php

namespace App\Repositories;

use App\Models\ProjectTSGaleryImageDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSGaleryImageDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:56 pm UTC
 *
 * @method ProjectTSGaleryImageDelete findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSGaleryImageDelete find($id, $columns = ['*'])
 * @method ProjectTSGaleryImageDelete first($columns = ['*'])
*/
class ProjectTSGaleryImageDeleteRepository extends BaseRepository
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
        return ProjectTSGaleryImageDelete::class;
    }
}
