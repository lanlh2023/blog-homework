<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class FilePath extends Enum
{
    const IMAGE_POSTS = '/images/';

    const IMAGE_POST_TITLE = self::IMAGE_POSTS.'post_title/';

    const IMAGE_AVATAR_FOLDER = self::IMAGE_POSTS.'avatars/';
}
