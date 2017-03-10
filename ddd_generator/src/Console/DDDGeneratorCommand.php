<?php
/**
 * Created by PhpStorm.
 * User: davi
 * Date: 2/28/17
 * Time: 4:39 PM
 */

namespace DDD\Generator\Console;

use DDD\Generator\Helpers\FileGenerator;
use Faker\Provider\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Symfony\Component\Console\Input\InputArgument;

class DDDGeneratorCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'ddd:generator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate project structure based on /path/to/domain_definition_file';

    /**
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('domain_file_definition', InputArgument::REQUIRED, 'path/to/domain_file_definition.php'),
        );
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $config = $this->getDDDGeneratorConfig();
        $domain_definition = $this->getDomainFileDefinition($this->argument('domain_file_definition'));

        $this->generateFiles($domain_definition,$config);

        $this->info('files created successfully!');
    }

    public function getDomainFileDefinition($file)
    {
        $domain_definition = require_once $file;
        return $domain_definition;
    }

    public function getDDDGeneratorConfig()
    {
        $app = Config::getFacadeApplication();
        return $app['config']['ddd_generator'];
    }

    public function generateFiles($domain_definition,$config)
    {
        foreach ($domain_definition as $domain => $entities) {

            $domainName = $domain;
            $replaceServiceProviderBinds['SERVICE_PROVIDER_BIND'] = "";

            foreach ($entities['entities'] as $entity=>$entityConfig){
                $entityName = $entity;

                if(isset($entityConfig['timestamps']) && $entityConfig['timestamps']){
                    $entityConfig['fields'] = FileGenerator::getTimestampsFields($entityConfig['fields']);
                }

                $replaces = FileGenerator::setFileReplaces($entityConfig,$entityName,$domainName,$config);

                $typesForGeneration = FileGenerator::getNoCrudFilesAvailable();

                if(isset($entityConfig['generate_crud']) && $entityConfig['generate_crud']) {
                    unset($typesForGeneration);
                    $typesForGeneration = FileGenerator::getFilesAvailable();
                }

                foreach ($typesForGeneration as $type => $name) {
                    $destination_path = $config['path']['dest_path'] . FileGenerator::getDirectoryName($domainName,$config['path'][$type]);
                    $fileName = FileGenerator::getFileNameByType($type,$domainName,$entityName,$config['namespace']['entity']);

                    $fileContent = FileGenerator::fillTemplate($type,$replaces);
                    FileGenerator::createFile($destination_path,$fileName,$fileContent);
                }

                $replaceServiceProviderBinds['SERVICE_PROVIDER_BIND'] .= FileGenerator::getServiceProviderBind($domainName,$entityName,$entityConfig);
            }

            //@TODO improve readbility
            if(strlen($replaceServiceProviderBinds['SERVICE_PROVIDER_BIND']) > 1 ){
                $domainNameNormalized = FileGenerator::formatTargetFileName($domainName);

                $replaceServiceProviderBinds['DOMAIN_NAME'] = $domainNameNormalized;
                $destination_path = $config['path']['dest_path'] . FileGenerator::getDirectoryName($domainName,$config['path']['service_provider']);
                $fileName = $domainNameNormalized."Provider.php";

                $fileContent = FileGenerator::fillTemplate('service_provider',$replaceServiceProviderBinds);
                FileGenerator::createFile($destination_path,$fileName,$fileContent);
            }

        }
    }
}