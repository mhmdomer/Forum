<?php

namespace App;

trait RecordsActivity
{
    protected static function bootRecordsActivity() {
        foreach (static::getActivitiesToRecord() as $event) {
            static::$event(function($model) use($event) {
                if(auth()->guest()) return;
                $model->recordActivity($event);
            });
        }
    }

    protected function recordActivity($event) {
        $this->activity()->create([
            'user_id' => auth()->id(),
            'type' => $this->getActivityType($event)
        ]);
    }

    protected static function getActivitiesToRecord() {
        return ['created'];
    }

    public function activity() {
        return $this->morphMany('App\Activity', 'subject');
    }

    protected function getActivityType($event) {
        $type = strtolower((new \ReflectionClass($this))->getShortName());
        return $event . '_' . $type;
    }
}