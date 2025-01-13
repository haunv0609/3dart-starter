<?php

namespace haunv\artStarter\Http\Controllers;

use Illuminate\Http\Request;
use League\Glide\Responses\SymfonyResponseFactory;
use League\Glide\ServerFactory;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    public function show(Request $request, string $path): StreamedResponse {
        $server = ServerFactory::create([
            'response' => new SymfonyResponseFactory($request),
            'source' => public_path(),
            'cache' => public_path(),
            'cache_path_prefix' => '.cache',
            'base_url' => 'cdn',
        ]);

        return $server->getImageResponse($path, $request->all());
    }
}
