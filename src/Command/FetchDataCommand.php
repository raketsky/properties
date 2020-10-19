<?php
declare(strict_types=1);

namespace App\Command;

use App\Service\PropertyService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Component\Property\Client as PropertyClient;

class FetchDataCommand extends Command
{
    protected static $defaultName = 'app:fetch-data';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $propertyClient = new PropertyClient(getConfig('api_url'), getConfig('api_key'));

        $propertyService = new PropertyService();

        $updatedAt = new \DateTimeImmutable();
        $pageNr = 1;
        $itemsPerPage = 100;
        $totalItemsFetched = 0;
        while (true) {
            $output->writeln('Fetching page ' . $pageNr);

            $propertiesDto = $propertyClient->getProperties($pageNr, $itemsPerPage);
            if (!$propertiesDto) {
                break;
            }
            $totalItemsFetched += count($propertiesDto);

            foreach ($propertiesDto as $propertyDTO) {
                try {
                    $output->write($propertyDTO->getUuid() . '..');
                    $propertyService->saveFromDto($propertyDTO, $updatedAt);
                    $output->writeln('OK');
                } catch (\Throwable $e) {
                    $output->writeln('ERROR [' . $e->getMessage() . ']');
                }
            }

            $output->writeln('Total fetched count: ' . $totalItemsFetched);
            sleep(2);
            $pageNr++;
        }

        $deletedPropertiesCount = $propertyService->removePropertiesOlderThan($updatedAt);
        $output->writeln('CLEANUP..' . $deletedPropertiesCount . '✨');

        return Command::SUCCESS;
    }
}
