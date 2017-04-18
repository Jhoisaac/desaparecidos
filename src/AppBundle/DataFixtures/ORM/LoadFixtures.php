<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;

class LoadFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        Fixtures::load(
            __DIR__.'/fixtures.yml',
            $manager,
            [
                'providers' => [$this]
            ]
        );
    }

    public function tipoOrg()
    {
        $genera = [
            'Hospital',
            'Morgue'
        ];

        $key = array_rand($genera);

        return $genera[$key];
    }

    public function organiz()
    {
        $genera = [
            'Hospital De Nanegalito',
            'Hospital Especialidades Eugenio Espejo',
            'Hospital Especialidades',
            'Hospital General Pablo Arturo',
            'Hospital Enrique Garcez',
            'Centro de Salud Pacto',
            'Centro de Salud Saguangal Barrio',
            'Centro de Salud nanegal',
            'Centro de Salud Gualea',
            'Centro de Salud Calderon',
            'Subcentro de Salud Carapungo',
            'Subcentro de salud Marianita de Calderon',
            'Subcentro de Salud De Guayllabamba',
            'Generiatico Gonzalo Gonzales',
            'Squiatrico Julio Endara',
            'Medicina legal Policia del Ecuador'
        ];

        $key = array_rand($genera);

        return $genera[$key];
    }

    public function ubicacion()
    {
        $genera = [
            'Calle Eloy Alfaro s/n y Guayaquil',
            'Av. Gran Colombia y Yaguach',
            'v.Gran Colombia y Yaguachi',
            'Angel Ludeña',
            'Calle 27 De marzo',
            'Calle Kennedy y Cumanda',
            'Barrio Gualea, calle principal 008',
            'zardo Becera y Carapungo',
            'Juan de Dios Martinez y Velasco',
            'Francisco Guañuna E10/210',
            'Av Simon Bolivar',
            'Republica Dominicana y José Tirado',
            'Calle Principal 11 de Noviembre',
            'Av. Manuel Córdova Galarza 2229',
            'Daniel Cevallos y Av. Equinoccial Esq',
            'Av. 12 De Octubre'
        ];

        $key = array_rand($genera);

        return $genera[$key];
    }

    public function correo()
    {
        $genera = [

            'hosp.nanegalito@gmail.com',
            'eugenio.espejo@gmail.com',
            'especialidades@hotmail.com',
            'pablo.arturo@gmail.com',
            'enrique.garcez@gmail.com',
            'pacto@gmail.com',
            'centrosaludsaguangal@hotmail.com',
            'centrosaludnanegal@gmail.com',
            'gualea@gmail.com',
            'calderon@gmail.com',
            'subcentro.carapungo@gmail.com',
            'subcentro.marianita@hotmail.com',
            'subcentro.guayllabamba@hotmail.com',
            'generiatico.gonzales@hotmail.com',
            'julio.endara@hotmail.com',
            'medicinalegal@gmail.com'
        ];

        $key = array_rand($genera);

        return $genera[$key];
    }

    public function telefono()
    {
        $genera = [
            '022411789', '023262323', '022298985', '022157081', '024776895', '022788467', '023260574', '022478267',
            '022884565', '023344565', '020084565', '021884565', '023284565', '023287775', '023262898', '022488789'
        ];

        $key = array_rand($genera);

        return $genera[$key];
    }

    public function rol()
    {
        $genera = [
            'Familiar',
            'Encargado'
        ];

        $key = array_rand($genera);

        return $genera[$key];
    }

    public function role()
    {
        $genera = [
            ['ROLE_FAMILIAR'],
            ['ROLE_ENCARGADO']
        ];

        $key = array_rand($genera);

        return $genera[$key];
    }

    public function cedula()
    {
        $genera = [
            '1735463724', '1276856476', '1446372857', '1121577081', '1024776895', '1552788467', '1633260574', '1882478267',
            '1722884565', '1253344565', '1400084565', '1121884565', '1053284565', '1573287775', '1613262898', '1882488789',
            '1764758934', '1257294756', '1412113758', '1146968121', '1011928577', '1519928471', '1609878913', '1809811823',
            '1700137436', '1212112374', '1418847512', '1149499574', '1085774623', '1501333756', '1685978472', '1818827774',
            '1781923764', '1211837432', '1418376342', '1191377431', '1088497273', '1509187365', '1681665432', '1811888462'
        ];

        $key = array_rand($genera);

        return $genera[$key];
    }

    public function celluser()
    {
        $genera = [
            '0935463724', '0976856476', '0946372857', '0921577081', '0924776895', '0952788467', '0933260574', '0982478267',
            '0922884565', '0953344565', '0900084565', '0921884565', '0953284565', '0973287775', '0913262898', '0982488789',
            '0964758934', '0957294756', '0912113758', '0986968121', '0911928577', '0919928471', '0909878913', '0909811823',
            '0900137436', '0912112374', '0918847512', '0919499574', '0985774623', '0901333756', '0985978472', '0918827774',
            '0981923764', '0911837432', '0918376342', '0991377431', '0988497273', '0909187365', '0981665432', '0911888462'
        ];

        $key = array_rand($genera);

        return $genera[$key];
    }

    public function tlfnuser()
    {
        $genera = [
            '025463724', '046856476', '056372857', '061577081', '034776895', '075278847', '083260574', '012478267',
            '022884565', '043344565', '050084565', '061884565', '033284565', '073287775', '083262898', '012488789',
            '024758934', '047294756', '052113758', '066968121', '031928577', '079928471', '089878913', '019811823',
            '020137436', '042112374', '058847512', '069499574', '035774623', '071333756', '085978472', '018827774',
            '021923764', '041837432', '058376342', '061377431', '038497273', '079187365', '081665432', '011888462'
        ];

        $key = array_rand($genera);

        return $genera[$key];
    }

    public function discapacidad()
    {
        $genera = [
            'Discapacidades físicas',
            'Discapacidades Cognitivo Intelectuales',
            'Discapacidades psíquicas',
            'Discapacidades sensoriales',
            'DIscapacidad Motriz',
            'Discapacidad Psicosocial',
            'Discapacidad auditiva',
            'Discapacidad visual',
            'Discapacidad visceral'

        ];

        $key = array_rand($genera);

        return $genera[$key];
    }

    public function partesCuerpo()
    {
        $genera = [
            'boca',
            'ceja',
            'mejilla',
            'mentón',
            'nariz',
            'ojos',
            'oreja',
            'cabeza',
            'cuello',
            'dientes',
            'frente',
            'párpados',
            'pestañas',
            'antebrazo',
            'brazo',
            'codo',
            'dedos',
            'hombro',
            'muñeca',
            'palma',
            'mano',
            'pulgar',
            'Abdomen',
            'dedo índice',
            'dedo medio',
            'dedo anular',
            'dedo meñique',
            'nudillo',
            'canilla',
            'dedo de los pies',
            'muslo',
            'nalga',
            'pie',
            'pierna',
            'rodilla',
            'tobillo',
            'talón'
        ];

        $key = array_rand($genera);

        return $genera[$key];
    }

    public function descripcionPartes()
    {
        $genera = [
            'Labios Finos',
            'cejas planas',
            'redondas',
            'menton cuadrado',
            'nariz recta',
            'ojos hundidos',
            'orejas alargadas y estrechas',
            'Triangular',
            'alargado',
            'rectos',
            'cuadradada',
            'Caidos',
            'medianas',
            'pequeño',
            'alargado',
            'codo mediano',
            'delgados',
            'hombros caidos',
            'delgada',
            'pequeña',
            'pequeña',
            'grueso',
            'plano',
            'delgado',
            'delgado',
            'delgado',
            'pequeño',
            'gruesos',
            'gruesos',
            'gruesos',
            'muslo',
            'nalga',
            'pie cuadrado',
            'pierna',
            'normal',
            'normal',
            'normal'
        ];

        $key = array_rand($genera);

        return $genera[$key];
    }

    public function rasgosDistintivos()
    {
        $genera = [
            'Tatuaje',
            'Lunares',
            'Bigote',
            'Cicatrices'

        ];

        $key = array_rand($genera);

        return $genera[$key];
    }

    public function descripcionRasgos()
    {
        $genera = [
            'espalda',
            'antebrazo',
            'blanco',
            'abdomen'
        ];

        $key = array_rand($genera);

        return $genera[$key];
    }


}