<?php

namespace App\Repositories;

use App\Models\CollegeTSFile;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSFileRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:45 pm UTC
 *
 * @method CollegeTSFile findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSFile find($id, $columns = ['*'])
 * @method CollegeTSFile first($columns = ['*'])
*/
class CollegeTSFileRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'file_type',
        'views_quantity',
        'updates_quantity',
        'status',
        'college_topic_section_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSFile::class;
    }
}
