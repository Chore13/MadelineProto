<?php

declare(strict_types=1);

namespace danog\MadelineProto\Db;

use danog\MadelineProto\Settings\Database\Memory;
use danog\MadelineProto\Settings\Database\Mysql;
use danog\MadelineProto\Settings\Database\PersistentDatabaseAbstract;
use danog\MadelineProto\Settings\Database\Postgres;
use danog\MadelineProto\Settings\Database\Redis;
use danog\MadelineProto\Settings\Database\SerializerType;
use danog\MadelineProto\Settings\DatabaseAbstract;
use InvalidArgumentException;

/**
 * This factory class initializes the correct database backend for MadelineProto.
 */
abstract class DbPropertiesFactory
{
    /**
     * @param SerializerType | array{serializer?: SerializerType, enableCache?: bool, cacheTtl?: int} $config
     * @return DbType
     * @internal
     * @uses \danog\MadelineProto\Db\MemoryArray
     * @uses \danog\MadelineProto\Db\MysqlArray
     * @uses \danog\MadelineProto\Db\PostgresArray
     * @uses \danog\MadelineProto\Db\RedisArray
     */
    public static function get(DatabaseAbstract $dbSettings, string $table, SerializerType|array $config, ?DbType $value = null)
    {
        $dbSettingsCopy = clone $dbSettings;
        $class = __NAMESPACE__;

        if ($dbSettingsCopy instanceof PersistentDatabaseAbstract) {
            if ($config instanceof SerializerType) {
                $config = [
                    'serializer' => $config
                ];
            }

            $config = array_merge([
                'serializer' => $dbSettings->getSerializer(),
                'enableCache' => true,
                'cacheTtl' => $dbSettings->getCacheTtl(),
            ], $config);

            $class = $dbSettings instanceof PersistentDatabaseAbstract && (!($config['enableCache'] ?? true) || !$config['cacheTtl'])
                ? __NAMESPACE__ . '\\NullCache'
                : __NAMESPACE__;

            $dbSettingsCopy->setSerializer($config['serializer']);
            $dbSettingsCopy->setCacheTtl($config['cacheTtl']);
        }

        switch (true) {
            case $dbSettings instanceof Memory:
                $class .= '\\MemoryArray';
                break;
            case $dbSettings instanceof Mysql:
                $class .= '\\MysqlArray';
                break;
            case $dbSettings instanceof Postgres:
                $class .= '\\PostgresArray';
                break;
            case $dbSettings instanceof Redis:
                $class .= '\\RedisArray';
                break;
            default:
                throw new InvalidArgumentException('Unknown dbType: ' . $dbSettings::class);
        }
        /** @var DbType $class */
        return $class::getInstance($table, $value, $dbSettingsCopy);
    }
}
