<?php

namespace App\Http\Controllers;

use App\Accommodation;
use App\AccommodationPhoto;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

/**
 * Class MediaController
 * @package App\Http\Controllers
 */
class MediaController extends Controller
{
    /**
     * @param int $accommodationId
     * @param int $photoId
     * @return Response
     */
    public function accommodationPhoto(int $accommodationId, int $photoId)
    {
        /** @var Accommodation|null $accommodation */
        $accommodation = Accommodation::find($accommodationId);

        if (empty($accommodation)) {
            abort(404);
        }

        /** @var AccommodationPhoto|null $photo */
        $photo = AccommodationPhoto::where('accommodation_id', '=', $accommodationId)
            ->where('id', '=', $photoId)
            ->first();

        if (empty($photo)) {
            abort(404);
        }

        try {
            $photoContent = Storage::disk('private')->get($photo->path);
        } catch (FileNotFoundException $e) {
            abort(404);
        }

        return response($photoContent, 200, [
            'Content-Type' => $photo->type,
            'Content-Length' => $photo->size,
            'Content-Disposition' => 'inline'
        ]);
    }
}
