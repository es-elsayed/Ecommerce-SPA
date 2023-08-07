<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'guard_name' => $this->guard_name,
            'created_at' => $this->created_at?->toDayDateTimeString(),
            'permissions' => PermissionResource::collection($this->whenLoaded('permissions')),
            'can' => [
                'update' => $request->user()?->can('roles-update'),
                'delete' => $request->user()?->can('roles-delete'),
            ],
        ];
    }
}
