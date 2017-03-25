<?php

namespace Damianopetrungaro\CleanArchitectureSlim\Users\Application\Controller;

use Damianopetrungaro\CleanArchitecture\UseCase\Response\ResponseInterface;
use Damianopetrungaro\CleanArchitectureSlim\Common\Container;
use Damianopetrungaro\CleanArchitectureSlim\Common\Response\SlimResponseBuilder;
use Damianopetrungaro\CleanArchitectureSlim\Users\Application\Request\AddUserRequest;
use Damianopetrungaro\CleanArchitectureSlim\Users\Domain\UseCase\AddUserUseCase;
use Slim\Http\Request;
use Slim\Http\Response;

final class DeleteUserController
{
    /**
     * @var DeleteUserUseCase
     */
    private $useCase;
    /**
     * @var ResponseInterface
     */
    private $domainResponse;
    /**
     * @var DeleteUserRequest
     */
    private $domainRequest;
    /**
     * @var SlimResponseBuilder
     */
    private $slimResponseBuilder;

    /**
     * ListUsersController constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->useCase = $container->getDeleteUserUseCase();
        $this->domainResponse = $container->getDomainResponse();
        $this->domainRequest = $container->getDeleteUserRequest();
        $this->slimResponseBuilder = $container->getSlimResponseBuilder();
    }

    /**
     * Controller for DeleteUserUseCase
     *
     * @param Request $request
     * @param Response $response
     * @param $args
     *
     * @return Response
     */
    public function __invoke(Request $request, Response $response, $args)
    {
        $this->useCase->__invoke($this->domainRequest->build($request), $this->domainResponse);
        $this->slimResponseBuilder->setDefaultSuccessStatusCode(201);
        
        return $this->slimResponseBuilder->build($this->domainResponse);
    }
}