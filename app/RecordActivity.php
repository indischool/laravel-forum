<?php

namespace App;

trait RecordActivity
{
    /**
     * 모델 이벤트 처리
     */
    protected static function bootRecordActivity()
    {
        if(auth()->guest()) {
            return;
        }

        foreach(static::getActivitiesToRecord() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($event);
            });
        }
    }

    /**
     * 기록할 활동 종류
     *
     * @return array
     */
    protected static function getActivitiesToRecord()
    {
        return ['created'];
    }

    /**
     * 활동 기록
     *
     * @param $event
     * @throws \ReflectionException
     */
    protected function recordActivity($event)
    {
        $this->activity()->create([
            'user_id' => auth()->id(),
            'type' => $this->getActivityType($event),
        ]);
    }

    /**
     * 활동
     *
     * @return mixed
     */
    public function activity()
    {
        return $this->morphMany('App\Activity', 'subject');
    }

    /**
     * Activity Type 반환
     *
     * @param $event
     * @return string
     * @throws \ReflectionException
     */
    protected function getActivityType($event)
    {
        $type = strtolower((new \ReflectionClass($this))->getShortName());

        return "{$event}_{$type}";
    }
}