<?php

namespace App\Http\Controllers\API\Like;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Like and unlike the specified resource from storage.
     */
    public function likeService($serviceId)
    {
        $user = Auth::user();
        $service = Service::findOrFail($serviceId);

        $like = Like::where('user_id', $user->id)
            ->where('service_id', $service->id)
            ->first();

        if ($like) {
            // User has already liked the service, so unlike it
            $like->delete();
            return response()->json(['message' => 'Service unliked']);
        } else {
            // User hasn't liked the service, so like it
            Like::create([
                'user_id' => $user->id,
                'service_id' => $service->id
            ]);
            return response()->json(['message' => 'Service liked']);
        }
    }
}
