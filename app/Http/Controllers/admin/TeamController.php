<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Team;
use Yajra\DataTables\Facades\DataTables;


use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $teams = Team::query();
    
            return DataTables::eloquent($teams)
                ->addColumn('team_img', function ($team) {
                    if ($team->team_img) {
                        return '<img src="' . asset($team->team_img) . '" style="height:50px; width:50px; border-radius:5px;">';
                    }
                    return 'No Image';
                })
                ->addColumn('status', function ($team) {
                    return $team->status == 1 
                        ? '<button class="btn btn-info btn-sm"><i class="fa fa-thumbs-up"></i></button>' 
                        : '<button class="btn btn-danger btn-sm"><i class="fa fa-thumbs-down"></i></button>';
                })
                ->addColumn('action', function ($team) {
                    return '<a href="' . route('admin.teams.edit', $team->id) . '" class="btn btn-info btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="' . route('admin.teams.destroy', $team->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this?\')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>';
                })
                ->rawColumns(['team_img', 'status', 'action'])
                ->make(true);
        }
        $teams=Team::latest();
        return view("admin.team.index",compact("teams"));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.team.form");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "fullname"=> "required",
        ]);
        $imagePath = null;
        if ($request->hasFile('team_img')) {
            $image = $request->file('team_img');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); // Unique filename
            $image->move(public_path('/uploads/teams'), $imageName); // Move image to folder
            $imagePath = '/uploads/teams/' . $imageName; // Save path to DB
        }
        Team::create([
            "fullname"=> $request->fullname,
            'designation' => $request->designation,
            'telephone' => $request->telephone,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'facebook_id' => $request->facebook_id,
            'twitter_id' => $request->twitter_id,
            'pinterest_id' => $request->pinterest_id,
            'profile'=> $request->profile,
            'team_img'=> $imagePath,
        ]);
        return redirect()->route('admin.teams.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $row=Team::where('id', $id)->firstOrFail();
        return view("admin.team.form",compact("row"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $teams = Team::where('id', $id)->firstOrFail();
     
        // Update title and slug if necessary
        // if ($teams->title !== $request->title) {
        //     $teams->slug = Str::slug($request->title);
        // }
    
        $teams->fullname = $request->fullname;
        $teams->designation = $request->designation;
        $teams->telephone = $request->telephone;
        $teams->mobile = $request->mobile;
        $teams->email = $request->email;
        $teams->facebook_id = $request->facebook_id;
        $teams->twitter_id = $request->twitter_id;
        $teams->pinterest_id = $request->pinterest_id;
        $teams->profile = $request->profile;    
    
        // Check if new image is uploaded   
        if ($request->hasFile('team_img')) {
            // Delete the old image if it exists
            $oldImagePath = public_path($teams->team_img);
            if (!empty($teams->team_img) && file_exists($oldImagePath)) {
                unlink($oldImagePath); // Delete file from public folder
            }
    
            // Store the new image and save the path
            $image = $request->file('team_img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/teams'), $imageName);
            $teams->team_img = '/uploads/teams/' . $imageName; // Store correct path
        }
    
        // Save the updated record
        $teams->save();
    
        return redirect()->route('admin.teams.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $record=Team::where('id', $id)->firstOrFail();
        $record->delete();
        return redirect()->route('admin.teams.index');  
    }
}
