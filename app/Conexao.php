<?php

    namespace Marketaco;

    /**
     * Classe de conexão
     */

class Conexao
     {

        /**
         * Connection
         * @var type 
         */
        private static $conn;

         /**
          * Connect to the database and return an instance of \PDO object
          * @return \PDO
          * @throws \Exception
          */

         public function connect()
         {
            //le os parametros do arquivo de configuração .ini
            $params = parse_ini_file('database.ini');
            if ($params === false)
            {
                throw new \Exception("Erro ao ler o arquivo de configuração");
            }
            //conecta com a database do postgresql
            $conStr = sprintf("pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s",
                            $params['host'],
                            $params['port'],
                            $params['database'],
                            $params['user'],
                            $params['password']);
              
            $pdo = new \PDO($conStr);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            return $pdo;
        }

        /**
         * retorna uma instancia do objeto Conexão
         * @return type
         */

        public static function get()
        {
            if (null === static::$conn)
            {
                static::$conn = new static();
            }

            return static::$conn;
        }

        protected function __construct() {

        }
     
        private function __clone() {

        }
     
        private function __wakeup() {

        }

     }