<?php


namespace App\Services;

use App\Http\Requests\HostCompanyRequest;
use App\Http\Requests\HostPersonRequest;
use App\Http\Requests\ServiceRequest;
use App\Notifications\UserCreatedNotification;
use App\User;
use App\UserAttachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class UserService
 * @package App\Services
 */
class UserService
{
    const defaultCountryIdForRefugee = 224;
    const defaultCountryId = 178;

    public function generateToken(User $user)
    {
        return app('auth.password.tokens')->create($user);
    }

    public function createRefugeeUser(ServiceRequest $request, bool $approved = false): User
    {
        $userParams = $this->prepareUserParams($request, $approved);
        $userParams['country_id'] = self::defaultCountryIdForRefugee;

        $user = User::create($userParams);
        $user->assignRole(User::ROLE_REFUGEE);
        return $user;
    }

    public function createTrustedUser($request, bool $approved = false): User
    {
        $userParams = $this->prepareUserParams($request, $approved);
        $userParams['country_id'] = self::defaultCountryId;
        $user = User::create($userParams);
        $user->assignRole(User::ROLE_TRUSTED);
        return $user;
    }

    public function createAdminUser($request, bool $approved = false): User
    {
        $userParams = $this->prepareUserParams($request, $approved);
        $userParams['country_id'] = self::defaultCountryId;
        $user = User::create($userParams);
        $user->assignRole(User::ROLE_ADMINISTRATOR);
        return $user;
    }

    /**
     * @param HostPersonRequest|HostCompanyRequest $request
     */
    public function createHostUser($request, bool $approved = false): User
    {
        $userParams = $this->prepareUserParams($request, $approved);
        $userParams['country_id'] = self::defaultCountryId;

        DB::beginTransaction();

        $user = User::create($userParams);
        try {
            $this->addHostIdAttachment($request instanceof HostCompanyRequest ? $request->file('new_user.cui_document') : $request->file('new_user.id_document'), $user);
        } catch (\Throwable $throwable) {
            DB::rollBack();

            throw $throwable;
        }
        $user->assignRole(User::ROLE_HOST);

        DB::commit();

        return $user;
    }

    /**
     * @param HostCompanyRequest|HostPersonRequest|ServiceRequest $request
     * @return array
     */
    private function prepareUserParams($request, bool $approved = true): array
    {
        $attributes = $request->new_user ?? $request->validated();

        $userParams = [
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => Hash::make(Str::random(10)),
            'remember_token' => Str::random(10),
            'country_id' => $attributes['country_id'] ?? null,
            'county_id' => $attributes['county_id'] ?? null,
            'city' => $attributes['city'],
            'address' => $attributes['address'] ?? null,
            'phone_number' => $attributes['phone'] ?? null,
            'approved_at' => now(),
            'created_by' => auth()->user()->id ?? null,
            'locale' => $attributes['locale'] ?? app()->getLocale(),
        ];

        if ($request instanceof HostCompanyRequest) {
            $userParams['legal_representative_name'] = $attributes['legal_representative_name'];
            $userParams['company_name'] = $attributes['company_name'];
            $userParams['company_tax_id'] = $attributes['company_tax_id'];
        }

        if ($approved) {
            $userParams['approved_at'] = now();
        }

        return $userParams;
    }

    private function addHostIdAttachment($fileInput, $user)
    {
        /** @var UploadedFile $file */
        $fileName = sha1((string)microtime() . $fileInput->getClientOriginalName()) . $fileInput->getClientOriginalExtension();

        /** @var string $path */
        $path = Storage::disk('private')->putFile('user_attachments/' . $user->id . '/id-doc/' . $fileName, $fileInput);

        $attachment = new UserAttachment();
        $attachment->user_id = $user->id;
        $attachment->name = $fileName;
        $attachment->identifier = sha1($path);
        $attachment->path = $path;
        $attachment->size = $fileInput->getSize();
        $attachment->extension = '.' . $fileInput->getClientOriginalExtension();
        $attachment->type = $fileInput->getClientMimeType();
        $attachment->save();
    }

    public function generateResetTokenAndNotifyUser(User $user): void
    {
        $user->notify(
            new UserCreatedNotification(
                Password::createToken($user)
            )
        );
    }

    public static function getChildrenUsers(): array
    {
        if (Auth::check()) {
            return User::where('created_by', auth()->user()->id)
                ->orderBy('name', 'ASC')
                ->get()
                ->toArray();
        }
        return [];
    }
}
