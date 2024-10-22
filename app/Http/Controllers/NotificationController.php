<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
 
  


    public function getNotifications(Request $request)
    {
        // Check if we want only unread notifications
        $isUnread = $request->query('unread', false); // Check for query parameter

        // Retrieve notifications
        $notifications = $isUnread ? Notification::where('is_read', false)->orderBy('created_at', 'desc')->get() : Notification::orderBy('created_at', 'desc')->get();

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $notifications->where('is_read', false)->count(), // Count unread notifications
        ]);
    }
            
            public function markNotificationsAsRead()
            {
                // Update notifications to mark them as read
                Notification::where('is_read', false)->update(['is_read' => true]);
            
                return response()->json(['status' => 'success']);
            }
        }
        
  
    

