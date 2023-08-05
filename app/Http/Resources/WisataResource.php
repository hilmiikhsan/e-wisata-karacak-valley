<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class WisataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $facilities = '<ul class="unordered-list">';
        foreach($this->facilities as $item) {
            $facilities .= '<li>' . $item->facility . '</li>';
        }
        $facilities .= '</ul>';

        return [
            'id' => $this->id,
            'wisata' => $this->wisata,
            'link_detail' => route('wisata.detail', $this->slug),
            'price' => number_format($this->price, 0, ',', '.'),
            'image' => $this->thumbnail == '' ? asset('img/default.png') : url(Storage::url($this->thumbnail)),
            'pin_image' => $this->category->thumbnail == '' ? asset('img/default.png') : url(Storage::url($this->category->thumbnail)),
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'facilities' => $facilities
        ];
    }
}
