<?php

namespace App\Repositories;

use App\Models\ProjectTSGaleryImageUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSGaleryImageUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:52 pm UTC
 *
 * @method ProjectTSGaleryImageUpdate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSGaleryImageUpdate find($id, $columns = ['*'])
 * @method ProjectTSGaleryImageUpdate first($columns = ['*'])
*/
class ProjectTSGaleryImageUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'project_t_s_g_image_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSGaleryImageUpdate::class;
    }
}
