<?php namespace Mnel\Peach\Extensions\Laravel;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

use Mnel\Peach\Client\Client;
use Mnel\Peach\Client\GuzzleClient;
use Mnel\Peach\Client\GuzzleResponseFormatter;
use Mnel\Peach\Client\XmlGuzzleResponseFormatter;
use Mnel\Peach\Commands\CommandBus;
use Mnel\Peach\Commands\CommandHandlerTransalator;
use Mnel\Peach\Commands\DefaultCommandBus;
use Mnel\Peach\Commands\Queries\QueryRequestTransformer;
use Mnel\Peach\Commands\Queries\QueryResponseTransformer;
use Mnel\Peach\Commands\Queries\Transformers\XmlQueryRequestTransformer;
use Mnel\Peach\Commands\Queries\Transformers\XmlQueryResponseTransformer;

use Mnel\Peach\Extensions\Laravel\Commands\Translators\LaravelCommandHandlerTransalator;

class ServiceProvider extends LaravelServiceProvider
{
    public function register()
    {
        $this->app->bind(Client::class, GuzzleClient::class);
        $this->app->bind(GuzzleResponseFormatter::class, XmlGuzzleResponseFormatter::class);

        $this->app->bind(QueryRequestTransformer::class, XmlQueryRequestTransformer::class);
        $this->app->bind(QueryResponseTransformer::class, XmlQueryResponseTransformer::class);

        $this->app->bind(CommandBus::class, DefaultCommandBus::class);
        $this->app->bind(CommandHandlerTransalator::class, LaravelCommandHandlerTransalator::class);
    }
}
