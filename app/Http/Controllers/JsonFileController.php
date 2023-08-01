<?php

namespace App\Http\Controllers;

use App\Helper\Facade\Responder;
use App\Repository\interface\JsonFileRepositoryInterface;

class JsonFileController extends Controller
{
    public function __construct(private JsonFileRepositoryInterface $jsonFileRepository)
    {
    }


    public function __invoke()
    {
       $data =  $this->jsonFileRepository->readFile();

        return Responder::success($data);
    }
}
