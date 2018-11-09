<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitce4e9017c27f7ab71dd67d7a7e557976
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Marketaco\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Marketaco\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Marketaco\\BLLCaixa' => __DIR__ . '/../..' . '/app/BLLCaixa.php',
        'Marketaco\\BLLLancamentoCaixa' => __DIR__ . '/../..' . '/app/BLLLancamentoCaixa.php',
        'Marketaco\\BLLOperador' => __DIR__ . '/../..' . '/app/BLLOperador.php',
        'Marketaco\\BLLPedido' => __DIR__ . '/../..' . '/app/BLLPedido.php',
        'Marketaco\\Caixa' => __DIR__ . '/../..' . '/app/Model/Caixa.php',
        'Marketaco\\Conexao' => __DIR__ . '/../..' . '/app/Conexao.php',
        'Marketaco\\DALCaixa' => __DIR__ . '/../..' . '/app/DALCaixa.php',
        'Marketaco\\DALLancamentoCaixa' => __DIR__ . '/../..' . '/app/DALLancamentoCaixa.php',
        'Marketaco\\DALOperador' => __DIR__ . '/../..' . '/app/DALOperador.php',
        'Marketaco\\DALPedido' => __DIR__ . '/../..' . '/app/DALPedido.php',
        'Marketaco\\FormaPagamento' => __DIR__ . '/../..' . '/app/Model/FormaPagamento.php',
        'Marketaco\\LancamentoCaixa' => __DIR__ . '/../..' . '/app/Model/LancamentoCaixa.php',
        'Marketaco\\Logs' => __DIR__ . '/../..' . '/app/Model/Logs.php',
        'Marketaco\\Operador' => __DIR__ . '/../..' . '/app/Model/Operador.php',
        'Marketaco\\Pedido' => __DIR__ . '/../..' . '/app/Model/Pedido.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitce4e9017c27f7ab71dd67d7a7e557976::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitce4e9017c27f7ab71dd67d7a7e557976::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitce4e9017c27f7ab71dd67d7a7e557976::$classMap;

        }, null, ClassLoader::class);
    }
}
