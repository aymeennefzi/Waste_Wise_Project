<?php

namespace App\Http\Controllers;

use App\Models\ItemPost; 
use App\Models\Meeting; 
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;


class AdminPostController extends Controller
{
    // Constructor to apply the admin middleware
    public function __construct()
    {
        $this->middleware(['auth', 'admin']); // Make sure to use the correct middleware names
    }

    // Method to show all itemPosts
    public function index(Request $request)
    {
        $query = ItemPost::with('user');
    
        // Search functionality
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
    
        // Pagination
        $itemPosts = $query->paginate(6); // You can set the number of items per page
    
        // Status counts for the chart
        $statusCounts = [
            'available' => Meeting::where('status', 1)->count(),
            'taken' => Meeting::where('status', 2)->count(),
            'refused' => Meeting::where('status', 3)->count(),
        ];
    
        return view('admin.Posts.index', compact('itemPosts', 'statusCounts'));
    }
    



    public function destroy($id)
    {
        // Retrieve the item post using the ID
        $itemPost = ItemPost::findOrFail($id);
    
        try {
            // Check if the item post has an associated image and delete it
            if ($itemPost->image) {
                Storage::disk('public')->delete($itemPost->image);
            }
    
            // Delete the item post from the database
            $itemPost->delete();
    
            return redirect()->route('admin.itemposts.index')->with('success', 'Item Post deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.itemposts.index')->with('error', 'Failed to delete Item Post: ' . $e->getMessage());
        }
    }


    public function edit($id)
    {
        $itemPost = ItemPost::find($id);
        return view('admin\Posts\update', compact('itemPost'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {          $itemPost = ItemPost::find($id);

        // Validate the input fields
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string|max:25555',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
        ]);
    
        // Initialize the image path
        // Assuming $itemPost is the model instance you are updating
    $imagePath = $itemPost->image; // Start with the existing image path

    if ($request->hasFile('image')) {
    // Get the uploaded file
    $file = $request->file('image');

    // Get the file extension
    $coverExtension = $file->getClientOriginalExtension();

    // Create the new filename
    $coverFilename = 'cover_' . time() . '.' . $coverExtension;

    // Store the new file
    $imagePath = $file->storeAs('assets/images', $coverFilename, 'public');

    // Optionally, delete the old image if it exists
    if ($itemPost->image) {
        // Use Storage facade to delete the old image
        \Storage::disk('public')->delete($itemPost->image);
    }
}

        // Update the model with the new image path
        $itemPost->image = $imagePath;
        $itemPost->save();    
        // Get the address from the coordinates
        $address = $this->getAddressFromCoordinates($request->input('lat'), $request->input('lng'));
    
        // Update the itemPost with the new data
        $itemPost->update([
            'name' => $request->input('name'),
            'category' => $request->input('category'),
            'description' => $request->input('description'),
            'lat' => $request->input('lat'),
            'lng' => $request->input('lng'),
            'address' => $address,
            'status' => 1, // Assuming you want to keep this status for all posts
        ]);
    
        return redirect()->route('admin.itemposts.index')->with('success', 'Item Post updated successfully!');
    }
    


    public function getAddressFromCoordinates($lat, $lng)
    {
        try {
            $url = "https://nominatim.openstreetmap.org/reverse?format=json&lat={$lat}&lon={$lng}&addressdetails=1";
    
            $response = Http::withHeaders([
                'User-Agent' => 'YourAppName (marwen.souissi000@gmail.com)'
            ])->get($url);
    
            // Check if the response was successful
            if ($response->successful()) {
                $data = $response->json();
    
                // Check if 'display_name' exists in the response
                if (isset($data['display_name'])) {
                    return $data['display_name'];
                } else {
                    return 'Address not found in response';
                }
            } else {
                return 'Failed to retrieve address, HTTP status code: ' . $response->status();
            }
        } catch (\Exception $e) {
            // Catch any errors that occur during the request
            return 'Error occurred while fetching address: ' . $e->getMessage();
        }
    }


}
