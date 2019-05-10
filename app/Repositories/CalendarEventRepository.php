<?php

namespace App\Repositories;

use App\Models\CalendarEvent;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CalendarEventRepository
 * @package App\Repositories
 * @version May 26, 2018, 8:12 pm UTC
 *
 * @method CalendarEvent findWithoutFail($id, $columns = ['*'])
 * @method CalendarEvent find($id, $columns = ['*'])
 * @method CalendarEvent first($columns = ['*'])
*/
class CalendarEventRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'start_date',
        'finish_date',
        'color',
        'views_quantity',
        'updates_quantity',
        'status',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CalendarEvent::class;
    }
}
