<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Trip;
use App\TripInfo;
use App\TripSeo;
use App\TripIncludeExclude;
use App\TripItinerary;
use App\TripGallery;
use Image;
use Illuminate\Support\Facades\Log;
use Mockery\Undefined;

class TripController extends Controller
{
    private $sizes = [
        'thumb' => [320, 240],
        'medium' => [615, 462],
        'large' => [1680, 900]
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trips = Trip::get()->toArray();
        return view('admin.trips.index', compact('trips'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $destinations = \App\Destination::orderBy('name')->get();
        $activities = \App\Activity::orderBy('name')->get();
        $regions = \App\Region::orderBy('name')->get();
        $trips = Trip::orderBy('name')->get();
        return view('admin.trips.add', compact('destinations', 'activities', 'regions', 'trips'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'cost' => 'numeric|nullable',
            'offer_price' => 'numeric|nullable',
            'pdf_file_name' => "mimes:pdf|max:10000",
            'map_file_name' => "mimes:jpeg,jpg,png,gif|max:10000",
            'og_image' => "mimes:jpeg,jpg,png,gif|max:10000",
        ]);

        $status = 0;
        $msg = "";
        $trip = new Trip;
        $trip->name = $request->name;
        $trip->location = $request->location;
        $trip->trip_code = $request->trip_code;
        $trip->cost = $request->cost;
        $trip->best_value = $request->best_value;
        $trip->duration = $request->duration;
        $trip->max_altitude = $request->max_altitude;
        $trip->group_size = $request->group_size;
        $trip->duration = $request->duration;
        $trip->offer_price = $request->offer_price;
        $trip->difficulty_grade = $request->difficulty_grade;
        $trip->starting_point = $request->starting_point;
        $trip->ending_point = $request->ending_point;
        $trip->rating = $request->rating;
        $trip->iframe = $request->iframe;
        $trip->show_status = $request->show_status;
        $trip->slug = $this->create_slug_title($trip->name);
        $trip->status = 1;
        $trip->show_status = 0;
        if ($request->show_status == "on") {
            $trip->show_status = 1;
        }

        if ($request->hasFile('map_file_name')) {
            $mapName = $request->map_file_name->getClientOriginalName();
            $trip->map_original_file_name = $mapName;
            $mapFileSize = $request->map_file_name->getClientSize();
            $mapImageType = $request->map_file_name->getClientOriginalExtension();
            $mapNameUniqid = md5($mapName . microtime()) . '.' . $mapImageType;
            $mapName = $mapNameUniqid;
            $trip->map_file_name = $mapName;
        }

        if ($request->hasFile('pdf_file_name')) {
            $pdfName = $request->pdf_file_name->getClientOriginalName();
            $trip->pdf_original_file_name = $pdfName;
            $pdfFileSize = $request->pdf_file_name->getClientSize();
            $pdfImageType = $request->pdf_file_name->getClientOriginalExtension();
            $pdfNameUniqid = md5($pdfName . microtime()) . '.' . $pdfImageType;
            $pdfName = $pdfNameUniqid;
            $trip->pdf_file_name = $pdfName;
        }

        if ($trip->save()) {
            // save region to the trip_region table
            if ($request->region_id) {
                $trip->region()->attach($request->region_id);
            }

            // save destination to the trip_destination table
            if ($request->destination_id) {
                $trip->destination()->attach($request->destination_id);
            }

            // save activities to the trip_activities table
            if ($request->activities) {
                $trip->activities()->attach($request->activities);
            }

            // save similar trips to the similar_trips table
            if ($request->similar_trips) {
                $trip->similar_trips()->attach($request->similar_trips);
            }

            // save addon trips to the similar_trips table
            if ($request->addon_trips) {
                $trip->addon_trips()->attach($request->addon_trips);
            }

            // save map.
            if ($request->hasFile('map_file_name')) {

                $image_quality = 100;

                if (($mapFileSize / 1000000) > 1) {
                    $image_quality = 75;
                }

                $path = 'public/trips/';

                $image = Image::make($request->map_file_name);

                Storage::put($path . $trip['id'] . '/' . $mapName, (string) $image->encode('jpg', $image_quality));

                $file = $path . $trip['id'] . '/' . $mapName;
                if (!Storage::exists($file)) {
                    $trip->map_file_name = "";
                    $trip->map_original_file_name = "";
                    $trip->save();
                }
            }

            // save pdf.
            if ($request->hasFile('pdf_file_name')) {

                $image_quality = 100;

                if (($pdfFileSize / 1000000) > 1) {
                    $image_quality = 75;
                }

                $path = 'public/trips/';

                Storage::putFileAs($path . $trip['id'], $request->pdf_file_name, $pdfName);

                $file = $path . $trip['id'] . '/' . $pdfName;
                if (!Storage::exists($file)) {
                    $trip->pdf_file_name = "";
                    $trip->pdf_original_file_name = "";
                    $trip->save();
                }
            }

            // save trip info
            if (isset($request->trip_info) && !empty($request->trip_info)) {
                $trip_info = json_decode($request->trip_info);
                $save_trip_info = $this->saveTripInfo($trip, (array) $trip_info);
            }

            // save trip include exclude
            if (isset($request->trip_include_exclude) && !empty($request->trip_include_exclude)) {
                $trip_include_exclude = json_decode($request->trip_include_exclude);
                $save_trip_include_exclude = $this->saveTripIncludeExclude($trip, (array) $trip_include_exclude);
            }

            // save trip seo exclude
            if (isset($request->trip_seo) && !empty($request->trip_seo)) {
                $trip_seo = $request->trip_seo;
                $save_trip_seo = $this->saveTripSeo($trip, $trip_seo);
            }

            // save trip seo exclude
            if (isset($request->trip_itineraries) && !empty($request->trip_itineraries)) {
                $trip_itineraries = $request->trip_itineraries;
                $this->saveTripItineraries($trip, (array) $trip_itineraries);
            }

            $status = 1;
            $msg = "Trip created successfully.";
            session()->flash('message', $msg);
        }

        return response()->json([
            'trip' => $trip,
            'status' => $status,
            'message' => $msg
        ]);
    }

    public function saveTripInfo(Trip $trip, $trip_info_data)
    {
        $trip_info = new TripInfo;
        $trip_info->fill($trip_info_data);
        if ($trip->trip_info()->save($trip_info)) {
            return 1;
        }
        return 0;
    }

    public function saveTripIncludeExclude(Trip $trip, $trip_include_data)
    {
        $item = new TripIncludeExclude;
        $item->fill($trip_include_data);
        if ($trip->trip_include_exclude()->save($item)) {
            return 1;
        }
        return 0;
    }

    public function saveTripSeo(Trip $trip, $data)
    {
        $item = new TripSeo;
        $item->fill($data);
        if ($trip->trip_seo()->save($item)) {
            return 1;
        }
        return 0;
    }

    public function saveTripItineraries(Trip $trip, $data)
    {
        $trip->trip_itineraries()->createMany($data);
        return 1;
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $trip = Trip::with([
            'destination' => function ($q) {
                $q->pluck('destination_id');
            },
            'region' => function ($q) {
                $q->pluck('region_id');
            },
            'activities' => function ($q) {
                $q->pluck('activity_id');
            },
            'trip_info',
            'trip_include_exclude',
            'trip_seo',
            'trip_itineraries' => function ($q) {
                $q->orderBy('display_order', 'asc');
            },
            'trip_galleries',
            'similar_trips',
            'addon_trips'
        ])->find($id);

        $trip_region = $trip->region;
        $regions = \App\Region::all();
        $tirp_destination = $trip->destination;
        $destinations = \App\Destination::all();
        $activity_ids = $trip->activities->pluck('id')->toArray();
        $activities = \App\Activity::all();
        $trips = Trip::orderBy('name', 'ASC')->where('id', '!=', $id)->get();
        $similar_trip_ids = $trip->similar_trips->pluck('id')->toArray();
        $addon_trip_ids = $trip->addon_trips->pluck('id')->toArray();
        return view('admin.trips.edit', compact('trip', 'destinations', 'tirp_destination', 'activities', 'activity_ids', 'trip_region', 'regions', 'trips', 'similar_trip_ids', 'addon_trip_ids'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'cost' => 'numeric|nullable',
            'offer_price' => 'numeric|nullable',
            'pdf_file_name' => "mimes:pdf|max:10000",
            'map_file_name' => "mimes:jpeg,jpg,png,gif|max:10000",
        ]);

        $status = 0;
        $msg = "";
        $trip = Trip::find($request->id);
        $trip->name = $request->name;
        $trip->location = $request->location;
        $trip->trip_code = $request->trip_code;
        $trip->cost = $request->cost;
        $trip->best_value = $request->best_value;
        $trip->duration = $request->duration;
        $trip->max_altitude = $request->max_altitude;
        $trip->group_size = $request->group_size;
        $trip->duration = $request->duration;
        $trip->offer_price = $request->offer_price;
        $trip->difficulty_grade = $request->difficulty_grade;
        $trip->starting_point = $request->starting_point;
        $trip->ending_point = $request->ending_point;
        $trip->rating = $request->rating;
        $trip->iframe = $request->iframe;
        $trip->show_status = $request->show_status;
        $trip->slug = $this->create_slug_title($trip->name);
        $trip->status = 1;
        $trip->show_status = 0;
        if ($request->show_status == "on") {
            $trip->show_status = 1;
        }

        if ($request->hasFile('map_file_name')) {
            $mapName = $request->map_file_name->getClientOriginalName();
            $old_map_file_name = $trip->map_file_name;
            $trip->map_original_file_name = $mapName;
            $mapFileSize = $request->map_file_name->getClientSize();
            $mapImageType = $request->map_file_name->getClientOriginalExtension();
            $mapNameUniqid = md5($mapName . microtime()) . '.' . $mapImageType;
            $mapName = $mapNameUniqid;
            $trip->map_file_name = $mapName;
        }

        if ($request->hasFile('pdf_file_name')) {
            $pdfName = $request->pdf_file_name->getClientOriginalName();
            $old_pdf_file_name = $trip->pdf_file_name;
            $trip->pdf_original_file_name = $pdfName;
            $pdfImageType = $request->pdf_file_name->getClientOriginalExtension();
            $pdfNameUniqid = md5($pdfName . microtime()) . '.' . $pdfImageType;
            $pdfName = $pdfNameUniqid;
            $trip->pdf_file_name = $pdfName;
        }

        if ($trip->save()) {
            // save region to the trip_region table
            if ($request->region_id) {
                $trip->region()->detach();
                $trip->region()->attach($request->region_id);
            }

            // save destination to the trip_destination table
            if ($request->destination_id) {
                $trip->destination()->detach();
                $trip->destination()->attach($request->destination_id);
            }

            // save activities to the trip_activities table
            if ($request->activities) {
                $trip->activities()->detach();
                $trip->activities()->attach($request->activities);
            }

            // save similar trips to the similar_trips table
            if ($request->similar_trips) {
                $trip->similar_trips()->detach();
                $trip->similar_trips()->attach($request->similar_trips);
            }

            // save similar trips to the addon_trips table
            if ($request->addon_trips) {
                $trip->addon_trips()->detach();
                $trip->addon_trips()->attach($request->addon_trips);
            }

            // save map.
            if ($request->hasFile('map_file_name')) {

                $image_quality = 100;

                if (($mapFileSize / 1000000) > 1) {
                    $image_quality = 75;
                }

                $path = 'public/trips/';

                $image = Image::make($request->map_file_name);


                // store new image
                Storage::put($path . $trip['id'] . '/' . $mapName, (string) $image->encode('jpg', $image_quality));

                // delete old image
                Storage::delete($path . $trip['id'] . '/' . $old_map_file_name);

                $file = $path . $trip['id'] . '/' . $mapName;
                if (!Storage::exists($file)) {
                    $trip->map_file_name = "";
                    $trip->map_original_file_name = "";
                    $trip->save();
                }
            } else {
                // check if trip has map file
                if ($request->has_map_file == 0) {
                    $path = 'public/trips/';
                    Storage::delete($path . $trip['id'] . '/' . $trip['map_file_name']);
                    $trip->map_file_name = "";
                    $trip->map_original_file_name = "";
                    $trip->save();
                }
            }

            // save pdf.
            if ($request->hasFile('pdf_file_name')) {

                $path = 'public/trips/';

                // store new pdf.
                Storage::putFileAs($path . $trip['id'], $request->pdf_file_name, $pdfName);

                // delete old pdf.
                Storage::delete($path . $trip['id'] . '/' . $old_pdf_file_name);

                $pdf_file = $path . $trip['id'] . '/' . $pdfName;
                if (!Storage::exists($pdf_file)) {
                    $trip->pdf_file_name = "";
                    $trip->pdf_original_file_name = "";
                    $trip->save();
                }
            } else {
                // check if trip has pdf file
                if ($request->has_pdf_file == 0) {
                    $path = 'public/trips/';
                    Storage::delete($path . $trip['id'] . '/' . $trip['pdf_file_name']);
                    $trip->pdf_file_name = "";
                    $trip->pdf_original_file_name = "";
                    $trip->save();
                }
            }


            $status = 1;
            $msg = "Trip updated successfully.";
            session()->flash('message', $msg);
        }

        return response()->json([
            'status' => $status,
            'message' => $msg
        ]);
    }

    public function updateTripInfo(Request $request)
    {
        // create or update trip info
        $status = 0;
        $msg = "";
        $http_status = 404;
        $trip_info = json_decode($request->trip_info);
        $trip_info_model = TripInfo::updateOrCreate(
            ['trip_id' => $request->id],
            (array) $trip_info
        );

        if ($trip_info_model) {
            $status = 1;
            $msg = "Trip updated.";
            $http_status = 200;
        }

        return response()->json([
            'status' => $status,
            'message' => $msg
        ], $http_status);
    }

    public function updateTripIncludes(Request $request)
    {
        // save trip include exclude
        $status = 0;
        $msg = "";
        $http_status = 404;

        $trip_include_exclude = json_decode($request->trip_include_exclude);
        $trip_include_model = TripIncludeExclude::updateOrCreate(
            ['trip_id' => $request->id],
            (array) $trip_include_exclude
        );

        if ($trip_include_model) {
            $status = 1;
            $msg = "Trip updated.";
            $http_status = 200;
        }

        return response()->json([
            'status' => $status,
            'message' => $msg
        ], $http_status);
    }

    public function updateTripMeta(Request $request)
    {
        $request->validate([
            'trip_seo.og_image' => "mimes:jpeg,jpg,png,gif|max:10000",
        ]);

        // save trip include exclude
        $status = 0;
        $msg = "";
        $http_status = 404;

        $trip_seo = $request->trip_seo;
        $trip_seo = TripSeo::updateOrCreate(
            ['trip_id' => $request->id],
            $trip_seo
        );

        if ($trip_seo) {
            if ($request->hasFile('trip_seo.og_image')) {
                $ogfile = $request->trip_seo['og_image'];
                $ogName = $ogfile->getClientOriginalName();
                $old_og_file_name = $trip_seo->og_image;
                // $trip->og_original_file_name = $ogName;
                $ogFileSize = $ogfile->getClientSize();
                $ogImageType = $ogfile->getClientOriginalExtension();
                $ogNameUniqid = md5($ogName . microtime()) . '.' . $ogImageType;
                $ogName = $ogNameUniqid;
                $trip_seo->og_image = $ogName;
                $trip_seo->save();

                $image_quality = 100;

                if (($ogFileSize / 1000000) > 1) {
                    $image_quality = 75;
                }

                $path = 'public/trip-seos/';

                $image = Image::make($ogfile);


                // store new image
                Storage::put($path . $trip_seo->trip_id . '/' . $ogName, (string) $image->encode('jpg', $image_quality));
                // delete old image
                Storage::delete($path . $trip_seo->trip_id . '/' . $old_og_file_name);

                $file = $path . $trip_seo->trip_id . '/' . $ogName;
                if (!Storage::exists($file)) {
                    $trip_seo->og_image = "";
                    $trip_seo->save();
                }
            }

            $status = 1;
            $msg = "Trip updated.";
            $http_status = 200;
        }

        return response()->json([
            'status' => $status,
            'message' => $msg
        ], $http_status);
    }

    public function updateTripItineraries(Request $request)
    {
        // save trip include exclude
        $status = 0;
        $msg = "";
        $http_status = 404;

        $trip_itineraries = $request->trip_itineraries;
        $trip = Trip::where('id', '=', $request->id)->first();

        // if (isset($trip->trip_itineraries) && !empty($trip->trip_itineraries)) {
        //     $trip->trip_itineraries()->delete();
        // }

        $existing_trip_itineraries = $trip->trip_itineraries()->pluck('id')->toArray();
        $updated_trip_itineraries = [];
        foreach ($trip_itineraries as $trip_itinerary) {
            if ($trip_itinerary['itinerary_id'] != "undefined") {
                $itinerary = TripItinerary::find($trip_itinerary['itinerary_id']);
                $updated_trip_itineraries[] = $trip_itinerary['itinerary_id'];
            } else {
                $itinerary = new TripItinerary();
            }
            $itinerary->trip_id = $trip->id;
            $itinerary->name = $trip_itinerary['name'];
            $itinerary->day = $trip_itinerary['day'];
            $itinerary->display_order = $trip_itinerary['display_order'];
            $itinerary->description = $trip_itinerary['description'];
            $itinerary->max_altitude = $trip_itinerary['max_altitude'];
            $itinerary->accomodation = $trip_itinerary['accomodation'];
            $itinerary->meals = $trip_itinerary['meals'];
            $itinerary->place = $trip_itinerary['place'];

            if (isset($trip_itinerary['image_name']) && !empty($trip_itinerary['image_name'])) {
                // check if the itinerary already has an image.
                if (!empty($itinerary->image_name)) {
                    // delete existing image.
                    Storage::delete('public/trips/' . $trip['id'] . "/itineraries/" . $itinerary->image_name);
                }
                $imageType = $trip_itinerary['image_name']->getClientOriginalExtension();
                $imageName = md5(microtime()) . '.' . $imageType;
                $itinerary->image_name = $imageName;
                $image_quality = 100;
                $imageFileSize = $trip_itinerary['image_name']->getClientSize();

                if (($imageFileSize / 1000000) > 1) {
                    $image_quality = 75;
                }

                $path = 'public/trips/' . $trip['id'] . "/itineraries/" . $imageName;

                $image = Image::make($trip_itinerary['image_name']);

                Storage::put($path, (string) $image->encode('jpg', $image_quality));
            }
            $itinerary->save();
        }
        // to be deleted itineraries
        $difference = array_diff($existing_trip_itineraries, $updated_trip_itineraries);
        $difference = array_values($difference);
        for ($i = 0; $i < count($difference); $i++) {
            // delete the images from the itineraries first.
            $diff_trip_itinerary = TripItinerary::find($difference[$i]);
            if (!empty($diff_trip_itinerary->image_name)) {
                // delete existing image.
                Storage::delete('public/trips/' . $trip['id'] . "/itineraries/" . $diff_trip_itinerary->image_name);
            }
            $diff_trip_itinerary->delete();
        }

        $status = 1;
        $msg = "Trip updated.";
        $http_status = 200;

        return response()->json([
            'status' => $status,
            'message' => $msg
        ], $http_status);
    }
    
      public function updateTripPriceRange(Request $request)
    {
        // save trip include exclude
        $status = 0;
        $msg = "";
        $http_status = 404;
        $trip = Trip::where('id', '=', $request->trip_id)->first();
        $trip_price_range_json = json_encode($request->trip_price_range);
        $trip->people_price_range = $trip_price_range_json;
        if ($trip->save()) {
            $msg = "Trip price range updated.";
            $http_status = 200;
            $status = 1;
        }

        return response()->json([
            'status' => $status,
            'message' => $msg
        ], $http_status);
    }

    public function storeTripGallery(Request $request)
    {
        $request->validate([
            'file' => "required|mimes:jpeg,jpg,png,gif|max:10000",
        ]);

        $status = 0;
        $msg = "";
        $gallery = new TripGallery;
        $gallery->status = 1;
        $gallery->caption = $request->caption;
        $gallery->trip_id = $request->trip_id;
        $gallery->alt_tag = $request->alt_tag;

        if ($request->hasFile('file')) {
            $imageName = $request->file->getClientOriginalName();
            $gallery->original_image_name = $imageName;
            $imageSize = $request->file->getClientSize();
            $imageType = $request->file->getClientOriginalExtension();
            $imageNameUniqid = md5($imageName . microtime()) . '.' . $imageType;
            $imageName = $imageNameUniqid;

            $gallery->image_name = $imageName;
        }

        if ($gallery->save()) {
            // save image.
            if ($request->hasFile('file')) {

                $image_quality = 100;

                if (($gallery->image_size / 1000000) > 1) {
                    $image_quality = 75;
                }

                $cropped_data = json_decode($request->cropped_data, true);
                $path = 'public/trip-galleries/';

                $image = Image::make($request->file);

                // crop image
                $image->crop(round($cropped_data['width']), round($cropped_data['height']), round($cropped_data['x']), round($cropped_data['y']));
                Storage::put($path . $gallery['trip_id'] . '/' . $imageName, (string) $image->encode('jpg', $image_quality));

                foreach ($this->sizes as $name => $size) {
                    $image = Image::make($request->file);
                    $image->crop(round($cropped_data['width']), round($cropped_data['height']), round($cropped_data['x']), round($cropped_data['y']));
                    $image->fit($size[0], $size[1]);
                    Storage::put($path . $gallery['trip_id'] . '/' . $name . '_' . $imageName, (string) $image->encode('jpg'));
                }
                $status = 1;
            }

            $status = 1;
            $msg = "Gallery saved successfully.";
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
        $path = 'public/trips/';

        if (Trip::find($id)->delete()) {
            Storage::deleteDirectory($path . $id);
            $status = 1;
            $http_status_code = 200;
            $msg = "Trip has been deleted";
        }

        return response()->json([
            'status' => $status,
            'message' => $msg
        ], $http_status_code);
    }

    public function getAllTripGallery($trip_id)
    {
        $data = TripGallery::where('trip_id', '=', $trip_id)->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function tripList(Request $request)
    {
        $query = Trip::query();
        $keyword = $request['query']['generalSearch'] ?? "";
        if (isset($keyword) && !empty($keyword)) {
            $query->where([
                ['name', 'LIKE', "%" . $keyword . "%"]
            ]);
        }
        $trips = $query->select('id', 'name', 'slug', 'block_1', 'block_2', 'block_3')->paginate(10, ['id', 'name', 'slug', 'block_1', 'block_2', 'block_3'], 'page', $request->pagination['page'])->toArray();
        return response()->json([
            'data' => $trips['data'],
            'meta' => [
                "page" => $trips['current_page'],
                "pages" => $trips['last_page'],
                "perpage" => $trips['per_page'],
                "total" => $trips['total']
            ],
        ]);
    }

    public function deleteTripImage($id)
    {
        $status = 0;
        $http_status_code = 400;
        $msg = "";
        $path = 'public/trip-galleries/';

        $gallery = TripGallery::find($id);

        $trip_id = $gallery->trip_id;
        $image_name = $gallery->image_name;

        if ($gallery->delete()) {
            Storage::delete($path . $trip_id . '/' . $image_name);
            Storage::delete($path . $trip_id . '/medium_' . $image_name);
            Storage::delete($path . $trip_id . '/thumb_' . $image_name);
            Storage::delete($path . $trip_id . '/large_' . $image_name);
            $status = 1;
            $http_status_code = 200;
            $msg = "Image has been deleted";
        }

        return response()->json([
            'status' => $status,
            'message' => $msg
        ], $http_status_code);
    }

    public function updateFeaturedStatus($id)
    {
        $success = false;
        $message = "";

        $trip = Trip::find($id);

        if ($trip) {
            if ($trip->featured == 1) {
                $trip->featured = 0;
            } else {
                $trip->featured = 1;
            }

            if ($trip->save()) {
                $message = "Trip has been featured.";
                $success = true;
            }
        } else {
            $message = __('alerts.not_found_error');
        }

        return response()->json([
            'data' => [],
            'success' => $success,
            'message' => $message
        ]);
    }

    public function updateBlock1Status($id)
    {
        $success = false;
        $message = "";

        $trip = Trip::find($id);

        if ($trip) {
            if ($trip->block_1 == 1) {
                $trip->block_1 = 0;
            } else {
                $trip->block_1 = 1;
            }

            if ($trip->save()) {
                $message = "Trip has been featured.";
                $success = true;
            }
        } else {
            $message = __('alerts.not_found_error');
        }

        return response()->json([
            'data' => [],
            'success' => $success,
            'message' => $message
        ]);
    }

    public function updateBlock2Status($id)
    {
        $success = false;
        $message = "";

        $trip = Trip::find($id);

        if ($trip) {
            if ($trip->block_2 == 1) {
                $trip->block_2 = 0;
            } else {
                $trip->block_2 = 1;
            }

            if ($trip->save()) {
                $message = "Trip has been featured.";
                $success = true;
            }
        } else {
            $message = __('alerts.not_found_error');
        }

        return response()->json([
            'data' => [],
            'success' => $success,
            'message' => $message
        ]);
    }

    public function updateBlock3Status($id)
    {
        $success = false;
        $message = "";

        $trip = Trip::find($id);

        if ($trip) {
            if ($trip->block_3 == 1) {
                $trip->block_3 = 0;
            } else {
                $trip->block_3 = 1;
            }

            if ($trip->save()) {
                $message = "Trip has been featured.";
                $success = true;
            }
        } else {
            $message = __('alerts.not_found_error');
        }

        return response()->json([
            'data' => [],
            'success' => $success,
            'message' => $message
        ]);
    }

    public function editSlider($id)
    {
        $slider = TripGallery::find($id);
        return view('admin.trips.edit-slider', compact('slider'));
    }

    public function updateTripGallery(Request $request)
    {
        $status = 0;
        $msg = "";
        $slider = TripGallery::find($request->id);
        $slider->alt_tag = $request->alt_tag;
        $slider->caption = $request->caption;
        $slider->status = 1;

        if ($request->hasFile('file')) {
            $imageName = $request->file->getClientOriginalName();
            $imageType = $request->file->getClientOriginalExtension();
            $imageNameUniqid = md5($imageName . microtime()) . '.' . $imageType;
            $imageName = $imageNameUniqid;

            $slider->image_name = $imageName;
        }

        if ($slider->save()) {
            // save image.
            if ($request->hasFile('file')) {

                $path = 'public/trip-galleries/';
                // Storage::deleteDirectory($path . $slider->trip_id);

                $image_quality = 100;

                if (($slider->image_size / 1000000) > 1) {
                    $image_quality = 75;
                }

                $cropped_data = json_decode($request->cropped_data, true);
                $path = 'public/trip-galleries/';

                $image = Image::make($request->file);

                // crop image
                $image->crop(round($cropped_data['width']), round($cropped_data['height']), round($cropped_data['x']), round($cropped_data['y']));
                Storage::put($path . $slider['trip_id'] . '/' . $imageName, (string) $image->encode('jpg', $image_quality));

                foreach ($this->sizes as $name => $size) {
                    $image = Image::make($request->file);
                    $image->crop(round($cropped_data['width']), round($cropped_data['height']), round($cropped_data['x']), round($cropped_data['y']));
                    $image->fit($size[0], $size[1]);
                    Storage::put($path . $slider['trip_id'] . '/' . $name . '_' . $imageName, (string) $image->encode('jpg'));
                }
                $status = 1;
            } else {
                if (isset($request->cropped_data) && !empty($request->cropped_data)) {
                    $cropped_data = json_decode($request->cropped_data, true);

                    $path = 'public/trip-galleries/';
                    $image = Image::make(Storage::get('public/trip-galleries/' . $slider->trip_id . '/' . $slider->image_name));
                    $images['large'] = Image::make(Storage::get('public/trip-galleries/' . $slider->trip_id . '/' . $slider->image_name));
                    $images['medium'] = Image::make(Storage::get('public/trip-galleries/' . $slider->trip_id . '/' . $slider->image_name));
                    $images['thumb'] = Image::make(Storage::get('public/trip-galleries/' . $slider->trip_id . '/' . $slider->image_name));

                    Storage::deleteDirectory($path . $slider->trip_id);

                    // crop image
                    $image->crop(round($cropped_data['width']), round($cropped_data['height']), round($cropped_data['x']), round($cropped_data['y']));

                    $ext = pathinfo($slider->image_name, PATHINFO_EXTENSION);

                    $imageNameUniqid = md5($slider->image_name . microtime()) . '.' . $ext;

                    Storage::put($path . $slider['trip_id'] . '/' . $imageNameUniqid, (string) $image->encode('jpg', 100));

                    foreach ($this->sizes as $name => $size) {
                        $images[$name]->fit($size[0], $size[1]);
                        Storage::put($path . $slider['trip_id'] . '/' . $name . '_' . $imageName, (string) $images[$name]->encode('jpg'));
                    }

                    $slider->image_name = $imageNameUniqid;
                    $slider->save();
                }
            }

            $status = 1;
            $msg = "Gallery updated successfully.";
            session()->flash('message', $msg);
        }

        return response()->json([
            'status' => $status,
            'message' => $msg
        ]);
    }
}
