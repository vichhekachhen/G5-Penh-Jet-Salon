<?php

namespace App\Http\Controllers\API\CardItem;

use App\Http\Controllers\Controller;
use App\Http\Resources\CardItemResource;
use App\Models\CardItem;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Undefined;

class CardController extends Controller
{

    /**
     * List all data.
     */

    public function index()
    {
        $user = Auth::user();
        $cards = CardItem::where('user_id', $user->id)->get();
        return response()->json([
            'success' => true,
            'message' => 'Service for pre_booking',
            'data' => CardItemResource::collection($cards)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cartItem = CardItem::find($id);
        if (!$cartItem) {
            return response()->json([
                'success' => true,
                'message' => 'Service in cart not found',
            ]);
        }
        $cartItem->delete();
        return response()->json([
            'success' => true,
            'message' => 'Service remove from cart successfully',
        ]);
    }

    /**
     * Add service to card ( pre-booking).
     */

    public function add(string $service_id)
    {
        // Check if the service exists
        $service = Service::find($service_id);
        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Service not found',
            ], 404);
        }

        $userAuth = Auth::user();

        $cartItem = CardItem::where('service_id', $service_id)
            ->where('user_id', $userAuth->id)
            ->first();

        if ($cartItem) {
            // If the re$request is already in the cart, increment its quantity
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            // If the re$request is not in the cart, create a new cart item
            CardItem::create([
                'service_id' => $service_id,
                'user_id' => $userAuth->id,
                'quantity' => 1,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Service added to cart successfully',
        ]);
    }
}
