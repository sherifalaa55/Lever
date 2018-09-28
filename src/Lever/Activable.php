<?php 

namespace SherifAlaa55\Lever;

use Illuminate\Support\Facades\Schema;

trait Activable {

	/**
     * Check if entity is active
     *
     * @return bool
     */
	public function isActive()
	{
		$this->validateEntity();

		return (bool)$this->active;
	}

	/**
     * Check if entity is inactive
     *
     * @return bool
     */
	public function isInactive()
	{
		return !$this->isActive();
	}

	public function activate($notes = null)
	{
		$this->validateEntity();
		$this->active = 1;
		$this->save();

		$activation = $this->activations()->create();
		$activation->active = 1;
		$activation->notes = $notes;
		$activation->save();

		return $activation;
	}

	public function deactivate($notes = null)
	{
		$this->validateEntity();
		$this->active = 0;
		$this->save();
		
		$activation = $this->activations()->create();
		$activation->active = 0;
		$activation->notes = $notes;
		$activation->save();

		return $activation;
	}

	public function activations()
	{
		return $this->morphMany('SherifAlaa55\Lever\Activation', 'activable');
	}

	public function activation()
	{
		return $this->activations()->latest()	->first();
	}

	/**
     * Entity Local scope for active records
     *
     * @return 
     */
	public function scopeActive($query)
    {
        return $query->where("active", 1);
    }

    /**
     * Entity Local scope for inactive records
     *
     * @return 
     */
    public function scopeInactive($query)
    {
        return $query->where("active", 0);
    }

    /**
     * Validates if entity has active column
     * @throws Exception
     * @return void
     */
	private function validateEntity()
	{
		if(!Schema::hasColumn($this->getTable(), \Config::get('lever.entity_column')))
			throw new \Exception("Table '" . $this->getTable() . "' does not have active column", 1);
	}
} 