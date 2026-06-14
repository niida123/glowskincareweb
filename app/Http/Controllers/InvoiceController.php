<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Models\Order;

class InvoiceController extends Controller
{
    public function __construct()
    {
        // Only publicShow is accessible without auth via signed URL
        $this->middleware('auth')->except(['publicShow']);
    }

    public function show(Order $order)
    {
        // Only owner can view
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }
        $order->load(['items.product','user']);
        // Owner can generate an immediate share link
        $shareUrl = URL::signedRoute('invoice.public', ['order' => $order->id]);
        return view('invoice.show', compact('order','shareUrl'));
    }

    public function publicShow(Order $order)
    {
        // Signed middleware already validates signature
        $order->load(['items.product','user']);
        return view('invoice.show', ['order' => $order, 'shareUrl' => null]);
    }

    public function createShareLink(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }
        // Generate a temporary signed URL (valid for 7 days)
        $shareUrl = URL::temporarySignedRoute('invoice.public', now()->addDays(7), ['order' => $order->id]);
        return response()->json(['url' => $shareUrl]);
    }
}
