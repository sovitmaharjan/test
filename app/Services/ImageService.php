<?php

use App\Models\Image;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public static function upload($model, $file, $oldFile = null, $type = 'default')
    {
        if ($oldFile !== null && Storage::exists($oldFile)) {
            Storage::delete($oldFile);
        }
        $fileName = rand() . time() . '.' . $file->extension();
        $path = "uploads/" . Carbon::now()->format('Y') . "/" . Carbon::now()->format('M') . '/';
        $filePath = $path . $fileName;
        $file->storeAs($path, $fileName);
        $user = Auth::user();
        $image = Image::updateOrCreate(
            [
                'imageable_id' => $model->id,
                'imageable_type' => get_class($model),
                'type' => $type,
            ],
            [
                'imageable_id' => $model->id,
                'imageable_type' => get_class($model),
                'path' => $filePath,
                'name' => $fileName,
                'uploadable_id' => $user->id,
                'uploadable_type' => get_class($user),
                'type' => $type,
            ]
        );
        return 1;
    }

    public function delete($model, $oldFile = null)
    {
        if ($oldFile !== null && Storage::exists($oldFile)) {
            Storage::delete($oldFile);
        }
        Image::where([
            'imageable_id' => $model->id,
            'imageable_type' => get_class($model)
        ])->delete();
        return 1;
    }
}
