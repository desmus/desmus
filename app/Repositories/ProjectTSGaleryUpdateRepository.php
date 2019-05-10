<?php

namespace App\Repositories;

use App\Models\ProjectTSGaleryUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSGaleryUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:51 pm UTC
 *
 * @method ProjectTSGaleryUpdate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSGaleryUpdate find($id, $columns = ['*'])
 * @method ProjectTSGaleryUpdate first($columns = ['*'])
*/
class ProjectTSGaleryUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'project_t_s_galery_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSGaleryUpdate::class;
    }
}
