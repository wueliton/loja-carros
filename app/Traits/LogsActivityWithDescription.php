<?php

namespace App\Traits;

use Spatie\Activitylog\LogOptions;

trait LogsActivityWithDescription
{
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn (string $eventName) => $this->setDescriptionForEvent($eventName));
    }

    public function setDescriptionForEvent(string $eventName): string
    {
        $userName = auth()->user()->name ?? 'Sistema';
        $modelName = $this->displayName ?? class_basename($this);
        $titleProperty = $this->displayProperty;

        $description = [
            'user' => $userName,
            'event' => $eventName,
            'model' => $modelName,
            'created_at' => now(),
            'title' => $this->$titleProperty,
            'id' => $this->id,
        ];

        return json_encode($description);
    }
}
