<?php

namespace App\Repositories;

use App\Models\CalendarEventDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CalendarEventDeleteRepository
 * @package App\Repositories
 * @version May 26, 2018, 8:13 pm UTC
 *
 * @method CalendarEventDelete findWithoutFail($id, $columns = ['*'])
 * @method CalendarEventDelete find($id, $columns = ['*'])
 * @method CalendarEventDelete first($columns = ['*'])
*/
class CalendarEventDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'calendar_event_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CalendarEventDelete::class;
    }
}
