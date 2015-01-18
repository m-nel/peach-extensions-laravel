<?php namespace Mnel\Peach\Extensions\Laravel\Commands\Translators;

use Illuminate\Container\Container;
use Mnel\Peach\Commands\Command;
use Mnel\Peach\Commands\CommandException;
use Mnel\Peach\Commands\CommandHandlerTransalator;

class LaravelCommandHandlerTransalator implements CommandHandlerTransalator
{
    /** @var Container */
    private $diContainer;

    public function __construct(Container $diContainer)
    {
        $this->diContainer = $diContainer;
    }

    public function translateCommand(Command $command)
    {
        $handlerClass = sprintf('%sHandler', get_class($command));

        if (!class_exists($handlerClass)) {
            throw new CommandException(sprintf('CommandHandler [%s] does not exist', $handlerClass));
        }

        try {
            return $this->diContainer->make($handlerClass);
        }
        catch (\Exception $e) {
            throw new CommandException($e->getMessage(), $e->getCode(), $e);
        }
    }

}
