<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;
use App\Banner;

class BannerController extends Controller
{
	private $sizes = [
		'thumb' => [320, 240],
		'medium' => [615, 462],
		'large' => [1680, 900]
	];

	public function index()
	{
		$banners = Banner::get()->toArray();
		return view('admin.banners.index', compact('banners'));
	}

	public function create()
	{
		return view('admin.banners.add');
	}

	public function store(Request $request)
	{
		$status = 0;
		$msg = "";
		$banner = new Banner;
		$banner->status = 1;
		$banner->caption = $request->caption;
		$banner->image_alt = $request->image_alt;
		$banner->btn_link = $request->btn_link;

		if ($request->hasFile('file')) {
			$imageName = $request->file->getClientOriginalName();
			$imageSize = $request->file->getClientSize();
			$imageType = $request->file->getClientOriginalExtension();
			$imageNameUniqid = md5($imageName . microtime()) . '.' . $imageType;
			$imageName = $imageNameUniqid;

			$banner->image_name = $imageName;
		}

		if ($banner->save()) {
			if ($request->hasFile('file')) {
				$image_quality = 100;

				if (($banner->image_size / 1000000) > 1) {
					$image_quality = 75;
				}

				$cropped_data = json_decode($request->cropped_data, true);
				$path = 'public/banners/';

				$image = Image::make($request->file);

				// crop image
				$image->crop(round($cropped_data['width']), round($cropped_data['height']), round($cropped_data['x']), round($cropped_data['y']));
				Storage::put($path . $banner['id'] . '/' . $imageName, (string) $image->encode('jpg', $image_quality));

				foreach ($this->sizes as $name => $size) {
					$image = Image::make($request->file);
					$image->crop(round($cropped_data['width']), round($cropped_data['height']), round($cropped_data['x']), round($cropped_data['y']));
					$image->fit($size[0], $size[1]);
					Storage::put($path . $banner['id'] . '/' . $name . '_' . $imageName, (string) $image->encode('jpg'));
				}
				$status = 1;
			}
			$status = 1;
			$msg = "Banner created successfully.";
			session()->flash('message', $msg);
		}

		return response()->json([
			'status' => $status,
			'message' => $msg
		]);
	}

	public function bannerList()
	{
		$banners = Banner::all();
		return response()->json([
			'data' => $banners
		]);
	}

	public function edit($id)
	{
		$banner = Banner::find($id);
		return view('admin.banners.edit', compact('banner'));
	}

	public function update(Request $request)
	{
		$status = 0;
		$msg = "";
		$banner = Banner::find($request->id);
		$banner->image_alt = $request->image_alt;
		$banner->caption = $request->caption;
		$banner->btn_link = $request->btn_link;
		$banner->status = 1;

		if ($request->hasFile('file')) {
			$imageName = $request->file->getClientOriginalName();
			$imageSize = $request->file->getClientSize();
			$imageType = $request->file->getClientOriginalExtension();
			$imageNameUniqid = md5($imageName . microtime()) . '.' . $imageType;
			$imageName = $imageNameUniqid;
			$banner->image_name = $imageName;
		}

		if ($banner->save()) {
			// save image.
			if ($request->hasFile('file')) {

				$path = 'public/banners/';
				Storage::deleteDirectory($path . $banner->id);

				$image_quality = 100;

				if (($banner->image_size / 1000000) > 1) {
					$image_quality = 75;
				}

				$cropped_data = json_decode($request->cropped_data, true);
				$path = 'public/banners/';

				$image = Image::make($request->file);

				// crop image
				$image->crop(round($cropped_data['width']), round($cropped_data['height']), round($cropped_data['x']), round($cropped_data['y']));
				Storage::put($path . $banner['id'] . '/' . $imageName, (string) $image->encode('jpg', $image_quality));

				foreach ($this->sizes as $name => $size) {
					$image = Image::make($request->file);
					$image->crop(round($cropped_data['width']), round($cropped_data['height']), round($cropped_data['x']), round($cropped_data['y']));
					$image->fit($size[0], $size[1]);
					Storage::put($path . $banner['id'] . '/' . $name . '_' . $imageName, (string) $image->encode('jpg'));
				}

				Storage::put($path . $banner['id'] . '/thumb_' . $imageName, (string) $image->encode('jpg', $image_quality));
				$status = 1;
			} else {
				if (isset($request->cropped_data) && !empty($request->cropped_data)) {
					$cropped_data = json_decode($request->cropped_data, true);

					$path = 'public/banners/';
					$image = Image::make(Storage::get('public/banners/' . $banner->id . '/' . $banner->image_name));
					$images['large'] = Image::make(Storage::get('public/banners/' . $banner->id . '/' . $banner->image_name));
					$images['medium'] = Image::make(Storage::get('public/banners/' . $banner->id . '/' . $banner->image_name));
					$images['thumb'] = Image::make(Storage::get('public/banners/' . $banner->id . '/' . $banner->image_name));

					Storage::deleteDirectory($path . $banner->id);

					// crop image
					$image->crop(round($cropped_data['width']), round($cropped_data['height']), round($cropped_data['x']), round($cropped_data['y']));
					$ext = pathinfo($banner->image_name, PATHINFO_EXTENSION);
					$imageNameUniqid = md5($banner->image_name . microtime()) . '.' . $ext;

					Storage::put($path . $banner['id'] . '/' . $imageNameUniqid, (string) $image->encode('jpg', 100));

					foreach ($this->sizes as $name => $size) {
						$images[$name]->fit($size[0], $size[1]);
						Storage::put($path . $banner['id'] . '/' . $name . '_' . $imageNameUniqid, (string) $images[$name]->encode('jpg'));
					}

					$banner->image_name = $imageNameUniqid;
					$banner->save();
				}
			}

			$status = 1;
			$msg = "Banner updated successfully.";
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
		$path = 'public/banners/';

		if (Banner::find($id)->delete()) {
			Storage::deleteDirectory($path . $id);
			$status = 1;
			$http_status_code = 200;
			$msg = "Banner has been deleted";
		}

		return response()->json([
			'status' => $status,
			'message' => $msg
		], $http_status_code);
	}
}
