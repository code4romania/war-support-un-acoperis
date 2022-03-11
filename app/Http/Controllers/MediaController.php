<?php

namespace App\Http\Controllers;

use App\Accommodation;

use App\AccommodationPhoto;
use App\UserAttachment;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Prophecy\Exception\Doubler\ClassNotFoundException;

/**
 * Class MediaController
 * @package App\Http\Controllers
 */
class MediaController extends Controller
{
    /**
     * @param int $accommodationId
     * @param string $identifier
     * @return Response
     */
    public function accommodationPhoto(int $accommodationId, string $identifier)
    {
        /** @var Accommodation|null $accommodation */
        $accommodation = Accommodation::find($accommodationId);

        if (empty($accommodation)) {
            abort(404);
        }

        /** @var AccommodationPhoto|null $photo */
        $photo = AccommodationPhoto::where('accommodation_id', '=', $accommodationId)
            ->where('identifier', '=', $identifier)
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

    public function attachmentContent(string $docType, int $docId, string $identifier)
    {
        /* ToDo - unify handling of all user related attachments in one place - accomodation ids & photo ids
        $className = urldecode($docType);
        try {
            $attachment = new $className();
        }
        catch (ClassNotFoundException $e)
        {
            abort(404);
        }
        */

        $attachment = UserAttachment::findOrFail($docId);
        if (empty($attachment->identifier) || empty($attachment->path)
            || $attachment->identifier != $identifier) {
            abort(404);
        }

        $loggedUser = Auth::user();

        if (
            $attachment->user_id != $loggedUser->id &&
            (
                !$loggedUser->isAdministrator() ||
                ($loggedUser->isTrusted() && $attachment->user()->created_by != $loggedUser->id)
            )
        ) {
            abort(403);
        }

        try {
            $photoContent = Storage::disk('private')->get($attachment->path);
        } catch (FileNotFoundException $e) {
            abort(404);
        }

        return response($photoContent, 200, [
            'Content-Type' => $attachment->type,
            'Content-Length' => $attachment->size,
            'Content-Disposition' => 'inline'
        ]);
    }
}
