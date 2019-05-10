<?php

namespace App\Repositories;

use App\Models\CollegeTSNote;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSNoteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:45 pm UTC
 *
 * @method CollegeTSNote findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSNote find($id, $columns = ['*'])
 * @method CollegeTSNote first($columns = ['*'])
*/
class CollegeTSNoteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'content',
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
        return CollegeTSNote::class;
    }
}
