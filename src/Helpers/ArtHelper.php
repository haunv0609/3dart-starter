<?php

function image(string $path, int $width, int $height): string {

    $data = app(\haunv\artStarter\Service\ImagePathGenerator::class)->generate($path, $width, $height);

    return $data;
}
