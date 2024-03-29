<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Patient;


class PatientShowResource extends JsonResource
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
            'pesel' => $this->pesel, 
            'name' => $this->name, 
            'lastname' => $this->lastname, 
            'birthday' => $this->birthday, 
            'diseases' => Patient::findOrFail($this->id)->diseases,

        ];
    }
}
