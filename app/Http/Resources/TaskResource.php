<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'prerequisites' => $this->when($this->prerequisites->count() >= 0, function () {
                $prerequisiteArr = [];
                foreach ($this->prerequisites as $prerequisite) {
                    array_push($prerequisiteArr, $prerequisite->prerequisite_task_id);
                }
                return $prerequisiteArr;
            }),
        ];
    }
}
