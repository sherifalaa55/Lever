<?php

namespace SherifAlaa55\Lever;

use Illuminate\Database\Eloquent\Model;

class Activation extends Model
{
    protected $table;
    
    protected $fillable = ["active", "notes"];

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->table = \Config::get('lever.table_name');
    }

	public function activable()
    {
        return $this->morphTo();
    }    
}
