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
        $propertiesDto = $propertyClient->getProperties();

        $updatedAt = new \DateTimeImmutable();
        foreach ($propertiesDto as $propertyDTO) {
            try {
                $output->write($propertyDTO->getUuid() . '..');
                $propertyService->saveFromDto($propertyDTO, $updatedAt);
                $output->writeln('OK');
            } catch (\Throwable $e) {
                $output->writeln('ERROR [' . $e->getMessage() . ']');
            }
        }

        $deletedPropertiesCount = $propertyService->removePropertiesOlderThan($updatedAt);
        $output->writeln('CLEANUP..' . $deletedPropertiesCount . '✨');

        return Command::SUCCESS;
    }
}
