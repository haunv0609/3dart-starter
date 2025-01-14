<?php

Route::get('cdn/{path}', [\haunv\artStarter\Http\Controllers\ImageController::class, 'show'])->where('path', '.*');
