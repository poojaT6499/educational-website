<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassesResource extends JsonResource
{
    /**
     * Indicates if the resource's collection keys should be preserved.
     *
     * @var bool
     */
    // public $preserveKeys = true;


    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'classes';


    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            // 'name' => $this->whenNotNull($this->name),
            // 'secret' => $this->when($request->user()->isAdmin(), 'secret-value'),
            // In this example, the secret key will only be returned in the final resource response if the authenticated user's isAdmin method returns true. If the method returns false, the secret key will be removed from the resource response before it is sent to the client.

            // $this->mergeWhen($request->user()->isAdmin(), [
            //     'first-secret' => 'value',
            //     'second-secret' => 'value',
            // ]),

            // 'expires_at' => $this->whenPivotLoaded('role_user', function () {
            //     return $this->pivot->expires_at;
            // }),
            // 'expires_at' => $this->whenPivotLoaded(new Membership, function () {
            //     return $this->pivot->expires_at;
            // }),
            // 'expires_at' => $this->whenPivotLoadedAs('subscription', 'role_user', function () {
            //     return $this->subscription->expires_at;
            // }),

        ];
    }
}
