<?php
/**
 * Created by PhpStorm.
 * User: davi
 * Date: 2/28/17
 * Time: 4:39 PM
 */

namespace DDD\Generator\Helpers;
use Symfony\Component\Yaml\Yaml;

class FileGenerator
{

    public static function setFileReplaces($entity_config,$entity_name,$domain_name,$config)
    {
        $replaces = [
            'DOMAIN_NAME'                => self::formatTargetFileName($domain_name),
            'LOWER_DOMAIN_NAME'          => strtolower($domain_name),
            'ENTITY_NAME'                => self::formatTargetFileName($entity_name),
            'LOWER_ENTITY_NAME'          => strtolower($entity_name),
            'REPOSITORY_TO_ARRAY_METHOD' => self::generateRepositoryToArrayMethod($entity_config['fields'],$entity_name),
            'REPOSITORY_UPDATE_METHOD'   => self::generateRepositoryUpdateMethod($entity_config['fields'],$entity_name),
            'ENTITY_PRIVATE_FIELDS'      => self::generateEntityPrivateFileds($entity_config['fields']),
            'ENTITY_SET_FIELDS'          => self::generateEntitySetFileds($entity_config['fields']),
            'ENTITY_GET_FIELDS'          => self::generateEntityGetFileds($entity_config['fields']),
            'MAPPING_YAML'               => self::generateYamlMappings($domain_name,$entity_name,$entity_config['fields']),
            'ENTITY_NAMESPACE'           => self::getFullEntityNamespace($config['namespace']['entity'],$entity_name,$domain_name),
            'TABLE'                      => $entity_config['table'],
        ];

        return $replaces;
    }

    public static  function fillTemplate($templateType, $replaces){
        $stub = file_get_contents(self::getStubsTemplatePath().$templateType.'.stub');

        foreach ($replaces as $search => $replace) {
            $stub = str_replace('{' . strtoupper($search) . '}', $replace, $stub);
        }

        //var_dump($stub);

        return $stub;
    }

    public static function createFile($path, $fileName, $contents)
    {
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        $path = $path.$fileName;

        file_put_contents($path, $contents);
    }

    public static function createDirectoryIfNotExist($path, $replace = false)
    {
        if (file_exists($path) && $replace) {
            rmdir($path);
        }

        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }
    }

    public static function deleteFile($path, $fileName)
    {
        if (file_exists($path.$fileName)) {
            return unlink($path.$fileName);
        }

        return false;
    }

    public static function getFilesAvailable()
    {
        return [
            'entity'              => '{ENTITY_NAME}.php',
            'repository_contract' => '{ENTITY_NAME}RepositoryContract.php',
            'repository'          => '{ENTITY_NAME}Repository.php',

            'entity_mapping'      => '{DOTTED_ENTITY_NAMESPACE}.dcm.yml',
            //'entity_mapping'      => '{DOTTED_ENTITY_NAMESPACE}.dcm.xml',

            'controller'          => '{DOMAIN_NAME}Controller.php',
            'application_service' => '{DOMAIN_NAME}Service.php',
            //'service_provider'    => '{DOMAIN_NAME}Provider.php',

            'route'              => '{LOWER_DOMAIN_NAME}.php'
        ];
    }

    public static function getNoCrudFilesAvailable()
    {
        return [
            'entity' => self::getFilesAvailable()['entity'],
            'entity_mapping' => self::getFilesAvailable()['entity_mapping']
        ];
    }


    public static function getServiceProviderAvailable(){
        return [
            'service_provider'    => '{DOMAIN_NAME}Provider.php',
        ];
    }


    public static function getFullEntityNamespace($entityNamespace,$entityName,$domainName)
    {
        $targetName = $entityNamespace . "\\" . self::formatTargetFileName($entityName) ;
        $targetName = str_replace('{DOMAIN_NAME}', self::formatTargetFileName($domainName), $targetName);
        return $targetName;
    }

    public static function getFileNameByType($typeFile,$domainName,$entityName,$entityNamespace='')
    {
        switch ($typeFile){
            case 'entity':
            case 'repository_contract':
            case 'repository':
                $targetName = self::formatTargetFileName($entityName);
                $targetName = str_replace('{ENTITY_NAME}',$targetName,self::getFilesAvailable()[$typeFile]);
                break;

            case 'entity_mapping':
                $targetName = $entityNamespace . "\\" . self::formatTargetFileName($entityName) ;
                $targetName = str_replace('{DOMAIN_NAME}', self::formatTargetFileName($domainName), $targetName);

                $targetName = str_replace('\\','.',$targetName);
                $targetName = str_replace('{DOTTED_ENTITY_NAMESPACE}',$targetName,self::getFilesAvailable()[$typeFile]);
                break;


            case 'controller':
            case 'application_service':
            case 'service_provider':
                $targetName = self::formatTargetFileName($domainName);
                $targetName = str_replace('{DOMAIN_NAME}',$targetName,self::getFilesAvailable()[$typeFile]);
                break;


            case 'route':
                $targetName = strtolower($domainName);
                $targetName = str_replace('{LOWER_DOMAIN_NAME}',$targetName,self::getFilesAvailable()[$typeFile]);
                break;

            default:
                $targetName = "UNKNOW_TYPE";
        }

        return $targetName;
    }


    public static function getDirectoryName($domainName,$pathDirectory)
    {
        $targetName = self::formatTargetFileName($domainName);
        $targetName = str_replace(['{DOMAIN_NAME}','{LOWER_DOMAIN_NAME}'],$targetName,$pathDirectory);
        return $targetName;
    }


    public static function formatTargetFileName($name)
    {
        $name = strtolower($name);
        $name = ucfirst($name);
        return $name;
    }

    public static function getStubsTemplatePath()
    {
        return  base_path('ddd_generator/templates/');
    }

    public static function getTimestampsFields($fields){

        $fields[] = [
            'name'=>'createdAt',
            'column'=>'created_at',
            'type'=>'datetime',
            'nullable'=>'false',
            'options' => [
                'default' => 'CURRENT_TIMESTAMP'
            ]
        ];

        $fields[] = [
            'name'=>'updatedAt',
            'column'=>'updated_at',
            'type'=>'datetime',
            'nullable'=>'true',
        ];

        $fields[] = [
            'name'=>'deletedAt',
            'column'=>'deleted_at',
            'type'=>'datetime',
            'nullable'=>'true',
        ];

        return $fields;
    }

    public static function generateEntityPrivateFileds($fields)
    {
        $privateAttributes = '';

        foreach ($fields as $field){

            $type = self::generateVariableTypeForPHPDoc($field['type']);

            $privateAttributes .=
<<<EOF

    /**
    * @var $type
    */
    private \${$field['name']};

EOF;
        }

        return $privateAttributes;
    }

    public static function generateSetMethodName($fieldName)
    {
        $fieldName = str_replace('_',' ',$fieldName);
        $fieldName = ucwords($fieldName);
        $fieldName = 'set'.str_replace(' ','',$fieldName);
        return $fieldName;
    }

    public static function generateGetMethodName($fieldName)
    {
        $fieldName = str_replace('_',' ',$fieldName);
        $fieldName = ucwords($fieldName);
        $fieldName = 'get'.str_replace(' ','',$fieldName);
        return $fieldName;
    }

    public static function generateEntitySetFileds($fields)
    {
        $setFields = '';

        foreach ($fields as $field){

            $type = self::generateVariableTypeForPHPDoc($field['type']);
            $setMethod = self::generateSetMethodName($field['name']);

            $paramAttribution = "\${$field['name']}";

            if($field['name'] == "createdAt" || $field['name'] == "updatedAt" || $field['name'] == "deletedAt" ){
                $paramAttribution = "new \\DateTime($paramAttribution)";
            }

            $setFields .=
<<<EOF

    /**
    * @param $type \${$field['name']}
    */ 
    public function $setMethod(\${$field['name']})
    {
        \$this->{$field['name']} = $paramAttribution;
    }

EOF;
        }

        return $setFields;
    }

    public static function generateEntityGetFileds($fields)
    {
        $getFields = '';

        foreach ($fields as $field){

            $type = self::generateVariableTypeForPHPDoc($field['type']);
            $getMethod = self::generateGetMethodName($field['name']);
            $getFields .=
<<<EOF

    /**
    * @return $type
    */
    public function $getMethod()
    {
        return \$this->{$field['name']};
    }

EOF;
        }

        return $getFields;
    }


    public static function getServiceProviderBind($domain_name, $entity_name, $entity_config)
    {
        $serviceProviderBind="";
        if(isset($entity_config['generate_crud']) && $entity_config['generate_crud']){

            $domain_name = self::formatTargetFileName($domain_name);
            $entity_name = self::formatTargetFileName($entity_name);

            $serviceProviderBind =
<<<EOF
\n\t\t\$this->app->bind('Domain\\$domain_name\Contracts\\{$entity_name}RepositoryContract', 'Infrastructure\Doctrine\Repositories\\{$domain_name}\\{$entity_name}Repository');\n
EOF;


        }

        return $serviceProviderBind;
    }


    public static function generateRepositoryUpdateMethod($fields,$entityName)
    {
        $updateMethod = '';
        $lowerEntityName = strtolower($entityName);

        foreach ($fields as $field){

            $setMethod = self::generateSetMethodName($field['name']);
            $updateMethod .=
<<<EOF

\t\t\$$lowerEntityName->$setMethod(\$data['{$field['name']}']);\n
EOF;
        }

        return $updateMethod;

    }


    public static function generateRepositoryToArrayMethod($fields,$entityName)
    {
        $toArrayMethod = '';
        $lowerEntityName = strtolower($entityName);

        foreach ($fields as $field){

            $getMethod = self::generateGetMethodName($field['name']);
            $toArrayMethod .=
<<<EOF

            "{$field['name']}" => \$$lowerEntityName->$getMethod(),
EOF;
        }

        return $toArrayMethod;
    }

    /**
     * @param $field
     * @return string
     */
    public static function generateVariableTypeForPHPDoc($fieldType)
    {
        $type = 'string';

        if ($fieldType == 'integer') {
            $type = 'integer';
        }

        if ($fieldType == 'datetime') {
            $type = '\DateTime';
        }

        return $type;
    }


    public static function generateYamlMappings($domainName, $entityName, $fields)
    {
        $namespace = "Domain\\{$domainName}\\Entities\\{$entityName}";

        $mappings = [
             $namespace => [
                 'type' => 'entity',
                 'table' => strtolower($entityName),
             ]
        ];

        foreach ($fields as $field) {

            $fieldName = $field['name'];
            $fieldMap = [];


            foreach ($field as $key => $value) {
                if (!in_array($key, ['pk', 'options', 'name'])) {

                    if(is_numeric($value)){
                        $valueFormated = intval($value);

                        if($value < $valueFormated){
                            $valueFormated = floatValue($value);
                        }

                        $value = $valueFormated;
                    }

                    if($value === 'true'){
                        $value = boolval($value);
                    }

                    $fieldMap[$key] = $value;
                }
            }

            if (!in_array('nullable',$field)) {
                $fieldMap['nullable'] = false;
            }

            $mainOption = ['fixed' => false];
            if ($field['type'] == 'integer') {
                $mainOption = ['unsigned' => false];
            }

            $fieldMap['options'] = $mainOption;

            if (isset($field['options']['default'])) {
                $fieldMap['options'] = ['default'=>$field['options']['default']];
            }

            if (isset($field['pk']) && $field['pk']) {
                $fieldMap['generator'] = ['strategy'=>'IDENTITY'];
                $fieldMap['id'] = true;

                $mappings[$namespace]['id']['id'] = $fieldMap;
            }
            else{
                $mappings[$namespace]['fields'][$fieldName] = $fieldMap;
            }

        }

        $yaml = Yaml::dump($mappings,6);

        return $yaml;
    }
}
