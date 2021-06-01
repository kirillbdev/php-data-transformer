<?php

namespace kirillbdev\PhpDataTransfer\DataObject\Laravel;

use Illuminate\Http\Request;
use kirillbdev\PhpDataTransfer\Contracts\DataObjectInterface;

class RequestDataObject implements DataObjectInterface
{
    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get(string $key, $default = null)
    {
        return $this->request->get($key, $default);
    }
}