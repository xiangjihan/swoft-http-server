<?php

namespace Swoft\Http\Server\Middleware;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Swoft\App;
use Swoft\Bean\Annotation\Bean;
use Swoft\Middleware\MiddlewareInterface;

/**
 * handler adapter
 *
 * @Bean()
 */
class HandlerAdapterMiddleware implements MiddlewareInterface
{
    /**
     * execute action
     *
     * @param \Psr\Http\Message\ServerRequestInterface     $request
     * @param \Psr\Http\Server\RequestHandlerInterface $handler
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $httpHandler = $request->getAttribute(RouterMiddleware::ATTRIBUTE);

        /* @var \Swoft\Http\Server\Router\HandlerAdapter $handlerAdapter */
        $handlerAdapter = App::getBean('httpHandlerAdapter');
        $response       = $handlerAdapter->doHandler($request, $httpHandler);

        return $response;
    }
}
