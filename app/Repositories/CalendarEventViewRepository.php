<?php

namespace App\Repositories;

use App\Models\CalendarEventView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CalendarEventViewRepository
 * @package App\Repositories
 * @version May 26, 2018, 8:13 pm UTC
 *
 * @method CalendarEventView findWithoutFail($id, $columns = ['*'])
 * @method CalendarEventView find($id, $columns = ['*'])
 * @method CalendarEventView first($columns = ['*'])
*/
class CalendarEventViewRepository extends BaseRepository
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
        return CalendarEventView::class;
    }
}
