<?php

namespace App\Http\Controllers\ApiOpen;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Lang;
use Illuminate\Support\Facades\File;

class MobileAppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function language($locale = 'fr')
    {
        // Ensure locale exists
        $path = resource_path("lang/fr");

        if (!File::exists($path)) {
            return response()->json(['error' => 'Locale not found'], 404);
        }

        $file = 'mobileApp.php';
        $filename = pathinfo($file, PATHINFO_FILENAME);
        $translations = trans($filename, [], $locale);

        return response()->json([
            'locale' => $locale,
            'translations' => $translations,
        ]);
    }

}
