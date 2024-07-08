<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Traits\ResponseTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *      title="blog.localhost",
 *      version="1.0",
 *      description="",
 *
 *      @OA\Contact(
 *          email="arsentiy.zhunussov@gmail.com"
 *      ),
 *
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="https://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 */
abstract class Controller
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ResponseTrait;
    use ValidatesRequests;
}
