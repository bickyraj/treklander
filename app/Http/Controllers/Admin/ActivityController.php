<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;
use App\Activity;
use App\Seo;
use Illuminate\Support\Facades\Log;

class ActivityController extends Controller
{
    private $sizes = [
        'thumb' => [320, 240],
        'medium' => [615, 462],
        'large' => [1680, 900]
    ];

    public function index()
    {
        $activities = Activity::get()->toArray();
        return view('admin.activities.index', compact('activities'));
    }

    public function create()
    {
        $destinations = \App\Destination::all();
        return view('admin.activities.add', compact('destinations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'seo.social_image' => "nullable|mimes:jpeg,jpg,png,gif|max:10000"
        ]);

        $status = 0;
        $msg = "";
        $activity = new Activity;
        $activity->name = $request->name;
        $activity->description = $request->description;
        $activity->slug = $this->create_slug_title($activity->name);
        $activity->status = 1;

        if ($request->hasFile('file')) {
            $imageName = $request->file->getClientOriginalName();
            $imageSize = $request->file->getClientSize();
            $imageType = $request->file->getClientOriginalExtension();
            $imageNameUniqid = md5($imageName . microtime()) . '.' . $imageType;
            $imageName = $imageNameUniqid;

            $activity->image_name = $imageName;
            $activity->image_type = $imageType;
            $activity->image_size = $imageSize;
        }

        if ($activity->save()) {
            // save seo
            if ($request->seo) {
                $this->createSeo($request->seo, $activity);
            }

            // save destination to the activity_destination table
            if ($request->destinations) {
                $activity->destinations()->attach($request->destinations);
            }
            // save image.
            if ($request->hasFile('file')) {

                $image_quality = 100;

                if (($activity->image_size / 1000000) > 1) {
                    $image_quality = 75;
                }

                $cropped_data = json_decode($request->cropped_data, true);
                $path = 'public/activities/';

                $image = Image::make($request->file);

                // crop image
                $image->crop(round($cropped_data['width']), round($cropped_data['height']), round($cropped_data['x']), round($cropped_data['y']));
                Storage::put($path . $activity['id'] . '/' . $imageName, (string) $image->encode('jpg', $image_quality));

                foreach ($this->sizes as $name => $size) {
                    $image = Image::make($request->file);
                    $image->crop(round($cropped_data['width']), round($cropped_data['height']), round($cropped_data['x']), round($cropped_data['y']));
                    $image->fit($size[0], $size[1]);
                    Storage::put($path . $activity['id'] . '/' . $name . '_' . $imageName, (string) $image->encode('jpg'));
                }

                $status = 1;
            }
            $status = 1;
            $msg = "Activity created successfully.";
            session()->flash('message', $msg);
        }

        return response()->json([
            'status' => $status,
            'message' => $msg
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $activity = Activity::with([
            'destinations' => function ($q) {
                $q->pluck('destination_id');
            },
            'seo'
        ])->find($id);

        $destination_ids = $activity->destinations->pluck('id')->toArray();
        $destinations = \App\Destination::all();
        return view('admin.activities.edit', compact('activity', 'destinations', 'destination_ids'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'seo.social_image' => "nullable|mimes:jpeg,jpg,png,gif|max:10000"
        ]);

        $status = 0;
        $msg = "";
        $activity = Activity::find($request->id);
        $activity->name = $request->name;
        $activity->description = $request->description;
        $activity->slug = $this->create_slug_title($activity->name);
        $activity->status = 1;

        if ($request->hasFile('file')) {
            $imageName = $request->file->getClientOriginalName();
            $imageSize = $request->file->getClientSize();
            $imageType = $request->file->getClientOriginalExtension();
            $imageNameUniqid = md5($imageName . microtime()) . '.' . $imageType;
            $imageName = $imageNameUniqid;

            $activity->image_name = $imageName;
            $activity->image_type = $imageType;
            $activity->image_size = $imageSize;
        }

        if ($activity->save()) {

            $this->updateSeo($request->seo, $activity);

            if ($request->destinations) {
                $activity->destinations()->detach();
                $activity->destinations()->attach($request->destinations);
            }

            // save image.
            if ($request->hasFile('file')) {

                $path = 'public/activities/';
                Storage::deleteDirectory($path . $activity->id);

                $image_quality = 100;

                if (($activity->image_size / 1000000) > 1) {
                    $image_quality = 75;
                }

                $cropped_data = json_decode($request->cropped_data, true);
                $path = 'public/activities/';

                $image = Image::make($request->file);

                // crop image
                $image->crop(round($cropped_data['width']), round($cropped_data['height']), round($cropped_data['x']), round($cropped_data['y']));
                Storage::put($path . $activity['id'] . '/' . $imageName, (string) $image->encode('jpg', $image_quality));

                foreach ($this->sizes as $name => $size) {
                    $image = Image::make($request->file);
                    $image->crop(round($cropped_data['width']), round($cropped_data['height']), round($cropped_data['x']), round($cropped_data['y']));
                    $image->fit($size[0], $size[1]);
                    Storage::put($path . $activity['id'] . '/' . $name . '_' . $imageName, (string) $image->encode('jpg'));
                }

                $status = 1;
            } else {
                if (isset($request->cropped_data) && !empty($request->cropped_data) && $activity->image_name) {
                    $ext = pathinfo($activity->image_name, PATHINFO_EXTENSION);
                    $imageNameUniqid = md5($activity->image_name . microtime()) . '.' . $ext;
                    $imageName = $imageNameUniqid;

                    $cropped_data = json_decode($request->cropped_data, true);

                    $path = 'public/activities/';
                    $image = Image::make(Storage::get('public/activities/' . $activity->id . '/' . $activity->image_name));
                    $images['large'] = Image::make(Storage::get('public/activities/' . $activity->id . '/' . $activity->image_name));
                    $images['medium'] = Image::make(Storage::get('public/activities/' . $activity->id . '/' . $activity->image_name));
                    $images['thumb'] = Image::make(Storage::get('public/activities/' . $activity->id . '/' . $activity->image_name));

                    Storage::deleteDirectory($path . $activity->id);

                    // crop image
                    $image->crop(round($cropped_data['width']), round($cropped_data['height']), round($cropped_data['x']), round($cropped_data['y']));
                    Storage::put($path . $activity['id'] . '/' . $imageName, (string) $image->encode('jpg', 100));

                    foreach ($this->sizes as $name => $size) {
                        $images[$name]->fit($size[0], $size[1]);
                        Storage::put($path . $activity['id'] . '/' . $name . '_' . $imageName, (string) $images[$name]->encode('jpg'));
                    }

                    $activity->image_name = $imageName;
                    $activity->save();
                }
            }

            $status = 1;
            $msg = "Activity created successfully.";
            session()->flash('message', $msg);
        }

        return response()->json([
            'status' => $status,
            'message' => $msg
        ]);
    }

    public function destroy($id)
    {
        $status = 0;
        $http_status_code = 400;
        $msg = "";
        $path = 'public/activities/';

        if (Activity::find($id)->delete()) {
            Storage::deleteDirectory($path . $id);
            $status = 1;
            $http_status_code = 200;
            $msg = "Activity has been deleted";
        }

        return response()->json([
            'status' => $status,
            'message' => $msg
        ], $http_status_code);
    }

    public function activityList()
    {
        $activities = Activity::all();
        return response()->json([
            'data' => $activities
        ]);
    }

    public function createSeo($request, $activity)
    {
        $seo = new Seo;
        $seo->meta_title = $request['meta_title'];
        $seo->meta_keywords = $request['meta_keywords'];
        $seo->canonical_url = $request['canonical_url'];
        $seo->meta_description = $request['meta_description'];
        $seo->seoable_id = $activity->id;
        $seo->seoable_type = "activity";

        if ($seo->save()) {
            if (isset($request['social_image']) && !empty($request['social_image'])) {
                $social_image = $request['social_image'];
                $socialImageName = $social_image->getClientOriginalName();
                $socialImageFileSize = $social_image->getClientSize();
                $socialImageType = $social_image->getClientOriginalExtension();
                $socialImageNameUniqid = md5(microtime()) . '.' . $socialImageType;
                $socialImageName = $socialImageNameUniqid;
                $seo->social_image = $socialImageName;

                $image_quality = 100;
                if (($socialImageFileSize / 1000000) > 1) {
                    $image_quality = 75;
                }

                $path = 'public/seos/';
                $image = Image::make($social_image);

                // store new image
                Storage::put($path . $seo->id . '/' . $socialImageName, (string) $image->encode('jpg', $image_quality));
                $file = $path . $seo->id . '/' . $socialImageName;

                $seo->save();
            }
            return 1;
        }

        return 0;
    }

    public function updateSeo($request, $activity)
    {
        if ($activity->seo) {
            $seo = $activity->seo;
        } else {
            $seo = new Seo;
            $seo->seoable_id = $activity->id;
            $seo->seoable_type = "activity";
        }

        $seo->meta_title = $request['meta_title'];
        $seo->meta_keywords = $request['meta_keywords'];
        $seo->canonical_url = $request['canonical_url'];
        $seo->meta_description = $request['meta_description'];

        if ($seo->save()) {
            if (isset($request['social_image']) && !empty($request['social_image'])) {
                $social_image = $request['social_image'];
                $social_image_name = $social_image->getClientOriginalName();
                $old_social_image_name = $seo->social_image;
                $socialImageFileSize = $social_image->getClientSize();
                $socialImageType = $social_image->getClientOriginalExtension();
                $social_image_name = md5(microtime()) . '.' . $socialImageType;
                $seo->social_image = $social_image_name;

                $image_quality = 100;
                if (($socialImageFileSize / 1000000) > 1) {
                    $image_quality = 75;
                }

                $path = 'public/seos/';
                $image = Image::make($social_image);

                // store new image
                Storage::put($path . $seo->id . '/' . $social_image_name, (string) $image->encode('jpg', $image_quality));
                // delete old image
                Storage::delete($path . $seo->id . '/' . $old_social_image_name);

                $file = $path . $seo->id . '/' . $social_image_name;
                if (!Storage::exists($file)) {
                    $seo->social_image = "";
                    $seo->save();
                }

                $seo->save();
            }
            return 1;
        }

        return 0;
    }
}
