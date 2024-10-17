<?php

namespace App\Http\Controllers;

use App\Models\ItemPost;
use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class ItemPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all ItemPost records where status = 1
        $itemPosts = ItemPost::where('status', 1)->get();
    
        // Pass the retrieved item posts to the view
        return view('item_posts.index', compact('itemPosts'));
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
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('item_posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string|max:25555',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
        ]);
    
        // Handle the image upload
        $imagePath = '';
        if ($request->hasFile('image')) {
            // Get the uploaded file
            $file = $request->file('image');
            
            // Get the file extension
            $coverExtension = $file->getClientOriginalExtension();
            
            // Create the new filename
            $coverFilename = 'cover_' . time() . '.' . $coverExtension;
            
            // Store the file with the new filename
            $imagePath = $file->storeAs('assets/images', $coverFilename, 'public');
        }
        
    
        // Get the address from coordinates
        $address = $this->getAddressFromCoordinates($request->input('lat'), $request->input('lng'));
        // Create the new ItemPost entry with the address
        ItemPost::create([
            'user_id' => Auth::id(),
            'name' => $request->input('name'),
            'category' => $request->input('category'),
            'image' => $imagePath,
            'description' => $request->input('description'),
            'lat' => $request->input('lat'),
            'lng' => $request->input('lng'),
            'address' => $address,
            'status' => 1,

        ]);
    
        return redirect()->route('item-posts.index')->with('success', 'Item Post created successfully!');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(ItemPost $itemPost)
    {
        return view('item_posts.show', compact('itemPost'));
    }

    
    public function userPosts()
    {
        // Get the posts that belong to the authenticated user along with the count of meetings
        $userPosts = ItemPost::where('user_id', Auth::id())->withCount('meetings')->get();
    
        return view('item_posts.user_posts', compact('userPosts'));
    }
    



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $itemPost = ItemPost::find($id);




        return view('item_posts\update', compact('itemPost'));
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
    
        return redirect()->route('item-posts.index')->with('success', 'Item Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $itemPost = ItemPost::findOrFail($id); // Retrieve the item post using the ID
    
        try {
            if ($itemPost->image) {
                Storage::disk('public')->delete($itemPost->image);
            }
    
            $itemPost->delete();
            return redirect()->route('item-posts.index')->with('success', 'Item Post deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('item-posts.index')->with('error', 'Failed to delete Item Post: ' . $e->getMessage());
        }
    }
    



}
