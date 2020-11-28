<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoxesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_boxes')->insert([

            
            [
                "id" => 1,
                "name" => "Caixa 1",
                "m_lat" => -25.72392911,
                "m_lng" => -53.77572684,
                "description" => "Caixa 1",
                "amount" => 16,
                "busy" => 3,
                "cities_id" => 1,
                "created_at" => "2020-11-27 23:52:49",
                "updated_at" => "2020-11-27 23:52:49"
            ],
            [
                "id" => 2,
                "name" => "Caixa 2",
                "m_lat" => -25.72351604,
                "m_lng" => -53.77356306,
                "description" => "Caixa 2",
                "amount" => 8,
                "busy" => 6,
                "cities_id" => 1,
                "created_at" => "2020-11-27 23:53:07",
                "updated_at" => "2020-11-27 23:53:07"
            ],
            [
                "id" => 3,
                "name" => "Caixa 3",
                "m_lat" => -25.72475366,
                "m_lng" => -53.7739118,
                "description" => "Caixa 3",
                "amount" => 16,
                "busy" => 7,
                "cities_id" => 1,
                "created_at" => "2020-11-27 23:53:25",
                "updated_at" => "2020-11-27 23:53:25"
            ],
            [
                "id" => 4,
                "name" => "Caixa 4",
                "m_lat" => -25.72080363,
                "m_lng" => -53.7722163,
                "description" => "Caixa 4",
                "amount" => 16,
                "busy" => 15,
                "cities_id" => 1,
                "created_at" => "2020-11-27 23:53:44",
                "updated_at" => "2020-11-27 23:53:44"
            ],
            [
                "id" => 5,
                "name" => "Caixa 5",
                "m_lat" => -25.67552795,
                "m_lng" => -53.79805898,
                "description" => "Caixa 5",
                "amount" => 16,
                "busy" => 6,
                "cities_id" => 2,
                "created_at" => "2020-11-27 23:54:10",
                "updated_at" => "2020-11-27 23:54:20"
            ],
            [
                "id" => 6,
                "name" => "Caixa 6",
                "m_lat" => -25.67839329,
                "m_lng" => -53.79702078,
                "description" => "Caixa 6",
                "amount" => 8,
                "busy" => 5,
                "cities_id" => 2,
                "created_at" => "2020-11-27 23:54:39",
                "updated_at" => "2020-11-27 23:54:45"
            ],
            [
                "id" => 7,
                "name" => "Caixa 7",
                "m_lat" => -25.67902558,
                "m_lng" => -53.79473436,
                "description" => "Caixa 7",
                "amount" => 16,
                "busy" => 7,
                "cities_id" => 2,
                "created_at" => "2020-11-27 23:55:04",
                "updated_at" => "2020-11-27 23:55:04"
            ],
            [
                "id" => 8,
                "name" => "Caixa 8",
                "m_lat" => -26.06733091,
                "m_lng" => -53.71647328,
                "description" => "Caixa 8",
                "amount" => 16,
                "busy" => 12,
                "cities_id" => 5,
                "created_at" => "2020-11-27 23:55:51",
                "updated_at" => "2020-11-27 23:55:57"
            ],
            [
                "id" => 9,
                "name" => "Caixa 9",
                "m_lat" => -26.06774709,
                "m_lng" => -53.71468692,
                "description" => "Caixa 9",
                "amount" => 16,
                "busy" => 11,
                "cities_id" => 5,
                "created_at" => "2020-11-27 23:56:17",
                "updated_at" => "2020-11-27 23:56:17"
            ],
            [
                "id" => 10,
                "name" => "Caixa 10",
                "m_lat" => -26.06708402,
                "m_lng" => -53.71222344,
                "description" => "Caixa 10",
                "amount" => 16,
                "busy" => 13,
                "cities_id" => 5,
                "created_at" => "2020-11-27 23:56:54",
                "updated_at" => "2020-11-27 23:57:00"
            ],
            [
                "id" => 11,
                "name" => "Caixa 11",
                "m_lat" => -26.01886144,
                "m_lng" => -53.73468964,
                "description" => "Caixa 11",
                "amount" => 16,
                "busy" => 1,
                "cities_id" => 4,
                "created_at" => "2020-11-27 23:57:34",
                "updated_at" => "2020-11-27 23:57:34"
            ],
            [
                "id" => 12,
                "name" => "Caixa 12",
                "m_lat" => -26.01867482,
                "m_lng" => -53.73554164,
                "description" => "Caixa 12",
                "amount" => 8,
                "busy" => 5,
                "cities_id" => 4,
                "created_at" => "2020-11-27 23:57:52",
                "updated_at" => "2020-11-27 23:57:52"
            ],
            [
                "id" => 13,
                "name" => "Caixa 13",
                "m_lat" => -26.01763365,
                "m_lng" => -53.73549532,
                "description" => "Caixa 13",
                "amount" => 16,
                "busy" => 2,
                "cities_id" => 4,
                "created_at" => "2020-11-27 23:58:10",
                "updated_at" => "2020-11-27 23:58:10"
            ],
            [
                "id" => 14,
                "name" => "Caixa 14",
                "m_lat" => -25.83469968,
                "m_lng" => -53.74525936,
                "description" => "Caixa 14",
                "amount" => 16,
                "busy" => 3,
                "cities_id" => 3,
                "created_at" => "2020-11-27 23:58:29",
                "updated_at" => "2020-11-27 23:58:29"
            ],
            [
                "id" => 15,
                "name" => "Caixa 15",
                "m_lat" => -25.8350389,
                "m_lng" => -53.74289917,
                "description" => "Caixa 15",
                "amount" => 8,
                "busy" => 5,
                "cities_id" => 3,
                "created_at" => "2020-11-27 23:58:49",
                "updated_at" => "2020-11-27 23:58:49"
            ],
            [
                "id" => 16,
                "name" => "Caixa 16",
                "m_lat" => -25.83335841,
                "m_lng" => -53.74325231,
                "description" => "Caixa 16",
                "amount" => 8,
                "busy" => 1,
                "cities_id" => 3,
                "created_at" => "2020-11-27 23:59:08",
                "updated_at" => "2020-11-27 23:59:08"
            ],
            [
                "id" => 17,
                "name" => "Caixa 17",
                "m_lat" => -25.87205428,
                "m_lng" => -53.66704782,
                "description" => "Caixa 17",
                "amount" => 8,
                "busy" => 1,
                "cities_id" => 6,
                "created_at" => "2020-11-27 23:59:42",
                "updated_at" => "2020-11-27 23:59:53"
            ],
            [
                "id" => 18,
                "name" => "Caixa 18",
                "m_lat" => -25.87440092,
                "m_lng" => -53.6676206,
                "description" => "Caixa 18",
                "amount" => 16,
                "busy" => 1,
                "cities_id" => 6,
                "created_at" => "2020-11-28 00:00:12",
                "updated_at" => "2020-11-28 00:00:12"
            ],
            [
                "id" => 19,
                "name" => "Caixa 19",
                "m_lat" => -25.87422025,
                "m_lng" => -53.66949627,
                "description" => "Caixa 19",
                "amount" => 16,
                "busy" => 4,
                "cities_id" => 6,
                "created_at" => "2020-11-28 00:00:36",
                "updated_at" => "2020-11-28 00:00:36"
            ],
               

            // [
            //     "name" => "CX 27 TORRE OI",
            //     "cities_id" => 6,
            //     "m_lat" => "-25.87974249954477",
            //     "m_lng" => "-53.665770194493234",
            //     "amount" => "16",
            //     "busy" => "16",
            //     "description" => "CX 27 TORRE OI"
            // ],
            // [
            //     "name" => "CX 20 PRA BAIXO DO TRENTIN",
            //     "cities_id" => 6,
            //     "m_lat" => "-25.880203422913183",
            //     "m_lng" => "-53.667749664746225",
            //     "amount" => "28",
            //     "busy" => "16",
            //     "description" => "CX 20 PRA BAIXO DO TRENTIN"
            // ],
            // [
            //     "name" => "CX 5 TRENTIN",
            //     "cities_id" => 6,
            //     "m_lat" => "-25.87976663170293",
            //     "m_lng" => "-53.666714332066476",
            //     "amount" => "16",
            //     "busy" => "9",
            //     "description" => "CX 5 TRENTIN"
            // ],
            // [
            //     "name" => "CX 6 SUL BRASIL",
            //     "cities_id" => 6,
            //     "m_lat" => "-25.880893597996593",
            //     "m_lng" => "-53.66635491605848",
            //     "amount" => "16",
            //     "busy" => "13",
            //     "description" => "CX 6 SUL BRASIL"
            // ],
            // [
            //     "name" => "CX 8 POSTO DE SUADE",
            //     "cities_id" => 6,
            //     "m_lat" => "-25.883253676718244",
            //     "m_lng" => "-53.66558512207121",
            //     "amount" => "28",
            //     "busy" => "24",
            //     "description" => "CX 8 POSTO DE SUADE"
            // ],
            // [
            //     "name" => "CX ESQUINA",
            //     "cities_id" => 6,
            //     "m_lat" => "-25.88118076755982",
            //     "m_lng" => "-53.66668482776731",
            //     "amount" => "8",
            //     "busy" => "8",
            //     "description" => "CX ESQUINA"
            // ],
            // [
            //     "name" => "CX 21 JACSON",
            //     "cities_id" => 6,
            //     "m_lat" => "-25.881144569754174",
            //     "m_lng" => "-53.66745193954557",
            //     "amount" => "20",
            //     "busy" => "14",
            //     "description" => "CX 21 JACSON"
            // ],
            // [
            //     "name" => "CX 3 COAGRO",
            //     "cities_id" => 6,
            //     "m_lat" => "-25.87783845672383",
            //     "m_lng" => "-53.66692622657865",
            //     "amount" => "8",
            //     "busy" => "8",
            //     "description" => "CX 3 COAGRO"
            // ],
            // [
            //     "name" => "CX 2 GINASIO DE ESPORTES",
            //     "cities_id" => 6,
            //     "m_lat" => "-25.876532878571336",
            //     "m_lng" => "-53.66728027816862",
            //     "amount" => "16",
            //     "busy" => "12",
            //     "description" => "CX 2 GINASIO DE ESPORTES"
            // ],
            // [
            //     "name" => "CX RT18 CX 3 DA RUA RIO DE JANEIRO",
            //     "cities_id" => 6,
            //     "m_lat" => "-25.878108740970827",
            //     "m_lng" => "-53.66837730165571",
            //     "amount" => "16",
            //     "busy" => "16",
            //     "description" => "CX RT18 CX 3 DA RUA RIO DE JANEIRO"
            // ],
            // [
            //     "name" => "CX RT 4 RELOGIO DO SICREDI",
            //     "cities_id" => 6,
            //     "m_lat" => "-25.878893044436094",
            //     "m_lng" => "-53.66685917135328",
            //     "amount" => "16",
            //     "busy" => "15",
            //     "description" => "CX RT 4 RELOGIO DO SICREDI"
            // ],
            // [
            //     "name" => "CX 16 INICIO DA RUA",
            //     "cities_id" => 6,
            //     "m_lat" => "-25.87599954212453",
            //     "m_lng" => "-53.66905053611845",
            //     "amount" => "8",
            //     "busy" => "8",
            //     "description" => "CX 16 INICIO DA RUA"
            // ],
            // [
            //     "name" => "CX 9 FINAL DA RUA",
            //     "cities_id" => 6,
            //     "m_lat" => "-25.882877225605405",
            //     "m_lng" => "-53.664126000367105",
            //     "amount" => "18",
            //     "busy" => "18",
            //     "description" => "CX 9 FINAL DA RUA"
            // ],
            // [
            //     "name" => "CX RT25 FUNDOS DA COAGRO",
            //     "cities_id" => 6,
            //     "m_lat" => "-25.87772986020041",
            //     "m_lng" => "-53.66601963993162",
            //     "amount" => "16",
            //     "busy" => "12",
            //     "description" => "CX RT25 FUNDOS DA COAGRO"
            // ],
            // [
            //     "name" => "CX TORRE OI RT28",
            //     "cities_id" => 6,
            //     "m_lat" => "-25.88060642773509",
            //     "m_lng" => "-53.66544832941145",
            //     "amount" => "16",
            //     "busy" => "16",
            //     "description" => "CX TORRE OI RT28"
            // ],
            // [
            //     "name" => "CX REDONDO RT 10",
            //     "cities_id" => 6,
            //     "m_lat" => "-25.88376526220434",
            //     "m_lng" => "-53.66743048187345",
            //     "amount" => "10",
            //     "busy" => "9",
            //     "description" => "CX REDONDO RT 10"
            // ],
            // [
            //     "name" => "CX 2 VOLTANDO CB QUE DESCE",
            //     "cities_id" => 6,
            //     "m_lat" => "-25.876742833887544",
            //     "m_lng" => "-53.66881450172514",
            //     "amount" => "16",
            //     "busy" => "16",
            //     "description" => "CX 2 VOLTANDO CB QUE DESCE"
            // ],
            // [
            //     "name" => "CX ROÇA",
            //     "cities_id" => 6,
            //     "m_lat" => "-25.877244794510116",
            //     "m_lng" => "-53.66969158407301",
            //     "amount" => "18",
            //     "busy" => "18",
            //     "description" => "CX ROÇA"
            // ],
            // [
            //     "name" => "PON 1.4 NAP 5",
            //     "cities_id" => 2,
            //     "m_lat" => "-25.664394218917696",
            //     "m_lng" => "-53.81249511614442",
            //     "amount" => "20",
            //     "busy" => "19",
            //     "description" => "PON 1.4 NAP 5"
            // ],
            // [
            //     "name" => "PON 3.1 NAP 2",
            //     "cities_id" => 2,
            //     "m_lat" => "-25.672091606539112",
            //     "m_lng" => "-53.81156254559755",
            //     "amount" => "16",
            //     "busy" => "16",
            //     "description" => "PON 3.1 NAP 2"
            // ],
            // [
            //     "name" => "PON 1.4 NAP 4",
            //     "cities_id" => 2,
            //     "m_lat" => "-25.66618081139917",
            //     "m_lng" => "-53.80996038671583",
            //     "amount" => "16",
            //     "busy" => "16",
            //     "description" => "PON 1.4 NAP 4"
            // ],
            // [
            //     "name" => "PON 1.8 NAP 7",
            //     "cities_id" => 2,
            //     "m_lat" => "-25.671579107480564",
            //     "m_lng" => "-53.799486360512674",
            //     "amount" => "16",
            //     "busy" => "16",
            //     "description" => "PON 1.8 NAP 7"
            // ],
            // [
            //     "name" => "PON 1.6 NAP 4",
            //     "cities_id" => 2,
            //     "m_lat" => "-25.670210820897942",
            //     "m_lng" => "-53.80951514001936",
            //     "amount" => "16",
            //     "busy" => "9",
            //     "description" => "PON 1.6 NAP 4"
            // ],
            // [
            //     "name" => "PON 1.6 NAP 6",
            //     "cities_id" => 2,
            //     "m_lat" => "-25.669500079266864",
            //     "m_lng" => "-53.812213484197855",
            //     "amount" => "8",
            //     "busy" => "7",
            //     "description" => "PON 1.6 NAP 6"
            // ],
            // [
            //     "name" => "PON 2.2 NAP 1",
            //     "cities_id" => 2,
            //     "m_lat" => "-25.68948625818039",
            //     "m_lng" => "-53.78239800687879",
            //     "amount" => "8",
            //     "busy" => "1",
            //     "description" => "PON 2.2 NAP 1"
            // ],
            // [
            //     "name" => "PON 2.2 NAP  5",
            //     "cities_id" => 2,
            //     "m_lat" => "-25.689742469477572",
            //     "m_lng" => "-53.780984482727945",
            //     "amount" => "8",
            //     "busy" => "2",
            //     "description" => "PON 2.2 NAP  5"
            // ],
            // [
            //     "name" => "PON 2.2 NAP  6",
            //     "cities_id" => 2,
            //     "m_lat" => "-25.689309810457136",
            //     "m_lng" => "-53.78046145197004",
            //     "amount" => "8",
            //     "busy" => "5",
            //     "description" => "PON 2.2 NAP  6"
            // ],
            // [
            //     "name" => "PON 2.2 NAP  7",
            //     "cities_id" => 2,
            //     "m_lat" => "-25.688640273567913",
            //     "m_lng" => "-53.77961735241115",
            //     "amount" => "8",
            //     "busy" => "6",
            //     "description" => "PON 2.2 NAP  7"
            // ],
            // [
            //     "name" => "PON 1.3 NAP 4",
            //     "cities_id" => 2,
            //     "m_lat" => "-25.656913932156076",
            //     "m_lng" => "-53.807074329815805",
            //     "amount" => "18",
            //     "busy" => "17",
            //     "description" => "PON 1.3 NAP 4"
            // ],
            // [
            //     "name" => "PON 1.3 NAP 5",
            //     "cities_id" => 2,
            //     "m_lat" => "-25.65568812614196",
            //     "m_lng" => "-53.806916079483926",
            //     "amount" => "8",
            //     "busy" => "8",
            //     "description" => "PON 1.3 NAP 5"
            // ],
            // [
            //     "name" => "PON 3.1 NAP 4",
            //     "cities_id" => 2,
            //     "m_lat" => "-25.670842990590717",
            //     "m_lng" => "-53.81447399966419",
            //     "amount" => "16",
            //     "busy" => "16",
            //     "description" => "PON 3.1 NAP 4"
            // ],
            // [
            //     "name" => "PON 3.1 NAP 5",
            //     "cities_id" => 2,
            //     "m_lat" => "-25.669961820060433",
            //     "m_lng" => "-53.814957342110574",
            //     "amount" => "18",
            //     "busy" => "18",
            //     "description" => "PON 3.1 NAP 5"
            // ],
            // [
            //     "name" => "PON 3.1 NAP 6",
            //     "cities_id" => 2,
            //     "m_lat" => "-25.66879658592867",
            //     "m_lng" => "-53.81522556301206",
            //     "amount" => "16",
            //     "busy" => "13",
            //     "description" => "PON 3.1 NAP 6"
            // ],
            // [
            //     "name" => "PON 3.1 NAP 7",
            //     "cities_id" => 2,
            //     "m_lat" => "-25.667853753295386",
            //     "m_lng" => "-53.814310929737985",
            //     "amount" => "18",
            //     "busy" => "18",
            //     "description" => "PON 3.1 NAP 7"
            // ],
            // [
            //     "name" => "PON 3.1 NAP 8",
            //     "cities_id" => 2,
            //     "m_lat" => "-25.66792144409185",
            //     "m_lng" => "-53.81325682159513",
            //     "amount" => "16",
            //     "busy" => "15",
            //     "description" => "PON 3.1 NAP 8"
            // ],
            // [
            //     "name" => "PON 2.2 NAP 2",
            //     "cities_id" => 2,
            //     "m_lat" => "-25.688698284133224",
            //     "m_lng" => "-53.78140558954328",
            //     "amount" => "8",
            //     "busy" => "6",
            //     "description" => "PON 2.2 NAP 2"
            // ],
            // [
            //     "name" => "PON 1.4 NAP 11",
            //     "cities_id" => 2,
            //     "m_lat" => "-25.661464052593026",
            //     "m_lng" => "-53.805671534501016",
            //     "amount" => "16",
            //     "busy" => "16",
            //     "description" => "PON 1.4 NAP 11"
            // ],
            // [
            //     "name" => "PON 1.4 NAP 2",
            //     "cities_id" => 2,
            //     "m_lat" => "-25.66606235075071",
            //     "m_lng" => "-53.80580836907029",
            //     "amount" => "16",
            //     "busy" => "15",
            //     "description" => "PON 1.4 NAP 2"
            // ],
            // [
            //     "name" => "PON 2.5 NAP 3",
            //     "cities_id" => 2,
            //     "m_lat" => "-25.686870937754332",
            //     "m_lng" => "-53.79403879400343",
            //     "amount" => "16",
            //     "busy" => "15",
            //     "description" => "PON 2.5 NAP 3"
            // ],
            // [
            //     "name" => "PON 2.4 NAP 5",
            //     "cities_id" => 2,
            //     "m_lat" => "-25.66897306402901",
            //     "m_lng" => "-53.803553469479084",
            //     "amount" => "8",
            //     "busy" => "4",
            //     "description" => "PON 2.4 NAP 5"
            // ],
            // [
            //     "name" => "PON 3 NAP 3 ESQUINA PARA COAGRO",
            //     "cities_id" => 3,
            //     "m_lat" => "-25.88825119282866",
            //     "m_lng" => "-53.7599398707971",
            //     "amount" => "16",
            //     "busy" => "16",
            //     "description" => "PON 3 NAP 3 ESQUINA PARA COAGRO"
            // ],
            // [
            //     "name" => "PON 3 NAP 2 CEREALISTA",
            //     "cities_id" => 3,
            //     "m_lat" => "-25.889315339631736",
            //     "m_lng" => "-53.75944634433836",
            //     "amount" => "8",
            //     "busy" => "7",
            //     "description" => "PON 3 NAP 2 CEREALISTA"
            // ],
            // [
            //     "name" => "PON 3 NAP 1 MERCADINHO",
            //     "cities_id" => 3,
            //     "m_lat" => "-25.890196088800902",
            //     "m_lng" => "-53.75904669519514",
            //     "amount" => "24",
            //     "busy" => "20",
            //     "description" => "PON 3 NAP 1 MERCADINHO"
            // ],
            // [
            //     "name" => "PON 3 NAP 6 COAGRO",
            //     "cities_id" => 3,
            //     "m_lat" => "-25.887843387996742",
            //     "m_lng" => "-53.75877847429365",
            //     "amount" => "16",
            //     "busy" => "13",
            //     "description" => "PON 3 NAP 6 COAGRO"
            // ],
            // [
            //     "name" => "PON 3 NAP 5 ESQUINA POSTO DE COMBUSTIVEL",
            //     "cities_id" => 3,
            //     "m_lat" => "-25.884547114985814",
            //     "m_lng" => "-53.76163502689451",
            //     "amount" => "16",
            //     "busy" => "16",
            //     "description" => "PON 3 NAP 5 ESQUINA POSTO DE COMBUSTIVEL"
            // ],
            // [
            //     "name" => "PON 3 NAP 4 MERCADO MENUSSI",
            //     "cities_id" => 3,
            //     "m_lat" => "-25.885558207048295",
            //     "m_lng" => "-53.76117368694395",
            //     "amount" => "16",
            //     "busy" => "11",
            //     "description" => "PON 3 NAP 4 MERCADO MENUSSI"
            // ],
            // [
            //     "name" => "PON 7 NAP 1",
            //     "cities_id" => 3,
            //     "m_lat" => "-25.82017173237933",
            //     "m_lng" => "-53.740670923143625",
            //     "amount" => "16",
            //     "busy" => "12",
            //     "description" => "PON 7 NAP 1"
            // ],
            // [
            //     "name" => "PON 7 NAP 2",
            //     "cities_id" => 3,
            //     "m_lat" => "-25.821791805157666",
            //     "m_lng" => "-53.74147558584809",
            //     "amount" => "16",
            //     "busy" => "10",
            //     "description" => "PON 7 NAP 2"
            // ],
            // [
            //     "name" => "PON 7 NAP 4",
            //     "cities_id" => 3,
            //     "m_lat" => "-25.824730092221085",
            //     "m_lng" => "-53.74291056767106",
            //     "amount" => "16",
            //     "busy" => "12",
            //     "description" => "PON 7 NAP 4"
            // ],
            // [
            //     "name" => "PON 7 NAP 5",
            //     "cities_id" => 3,
            //     "m_lat" => "-25.826236630192252",
            //     "m_lng" => "-53.74367231503129",
            //     "amount" => "16",
            //     "busy" => "11",
            //     "description" => "PON 7 NAP 5"
            // ],
            // [
            //     "name" => "PON 7 NAP 6",
            //     "cities_id" => 3,
            //     "m_lat" => "-25.827714177657047",
            //     "m_lng" => "-53.74440724030137",
            //     "amount" => "16",
            //     "busy" => "10",
            //     "description" => "PON 7 NAP 6"
            // ],
            // [
            //     "name" => "PON 7 NAP 7",
            //     "cities_id" => 3,
            //     "m_lat" => "-25.8291458359579",
            //     "m_lng" => "-53.74509925022721",
            //     "amount" => "16",
            //     "busy" => "16",
            //     "description" => "PON 7 NAP 7"
            // ],
            // [
            //     "name" => "PON 7 NAP 8",
            //     "cities_id" => 3,
            //     "m_lat" => "-25.83062334710998",
            //     "m_lng" => "-53.745800061151385",
            //     "amount" => "16",
            //     "busy" => "12",
            //     "description" => "PON 7 NAP 8"
            // ],
            // [
            //     "name" => "PON 7 NAP 06",
            //     "cities_id" => 1,
            //     "m_lat" => "-25.71414286030673",
            //     "m_lng" => "-53.77026189118624",
            //     "amount" => "16",
            //     "busy" => "16",
            //     "description" => "PON 7 NAP 06"
            // ],
            // [
            //     "name" => "PON 8 NAP 4",
            //     "cities_id" => 1,
            //     "m_lat" => "-25.71704031609957",
            //     "m_lng" => "-53.77457400318235",
            //     "amount" => "16",
            //     "busy" => "16",
            //     "description" => "PON 8 NAP 4"
            // ],
            // [
            //     "name" => "PON 6 NAP 01",
            //     "cities_id" => 1,
            //     "m_lat" => "-25.725876124815326",
            //     "m_lng" => "-53.761321404335966",
            //     "amount" => "16",
            //     "busy" => "10",
            //     "description" => "PON 6 NAP 01"
            // ],
            // [
            //     "name" => "PON 4 NAP 04",
            //     "cities_id" => 1,
            //     "m_lat" => "-25.717980342892563",
            //     "m_lng" => "-53.764357469044626",
            //     "amount" => "16",
            //     "busy" => "4",
            //     "description" => "PON 4 NAP 04"
            // ],
            // [
            //     "name" => "PON 4 NAP 05",
            //     "cities_id" => 1,
            //     "m_lat" => "-25.717091063236936",
            //     "m_lng" => "-53.76396318431944",
            //     "amount" => "18",
            //     "busy" => "11",
            //     "description" => "PON 4 NAP 05"
            // ],
            // [
            //     "name" => "PON 4 NAP 06",
            //     "cities_id" => 1,
            //     "m_lat" => "-25.71642893221928",
            //     "m_lng" => "-53.763880035839975",
            //     "amount" => "18",
            //     "busy" => "11",
            //     "description" => "PON 4 NAP 06"
            // ],
            // [
            //     "name" => "PON 4 NAP 07",
            //     "cities_id" => 1,
            //     "m_lat" => "-25.716320187721713",
            //     "m_lng" => "-53.763139746151865",
            //     "amount" => "16",
            //     "busy" => "10",
            //     "description" => "PON 4 NAP 07"
            // ],
            // [
            //     "name" => "PON 2.1 NAP 8",
            //     "cities_id" => 1,
            //     "m_lat" => "-25.720179348278105",
            //     "m_lng" => "-53.759416840039194",
            //     "amount" => "16",
            //     "busy" => "13",
            //     "description" => "PON 2.1 NAP 8"
            // ],
            // [
            //     "name" => "PON 6 NAP 10",
            //     "cities_id" => 1,
            //     "m_lat" => "-25.726923516728164",
            //     "m_lng" => "-53.75742395874113",
            //     "amount" => "16",
            //     "busy" => "16",
            //     "description" => "PON 6 NAP 10"
            // ],
            // [
            //     "name" => "PON 1.5 NAP 03",
            //     "cities_id" => 1,
            //     "m_lat" => "-25.71811325096572",
            //     "m_lng" => "-53.75949194189161",
            //     "amount" => "16",
            //     "busy" => "9",
            //     "description" => "PON 1.5 NAP 03"
            // ],
            // [
            //     "name" => "PON 5 NAP 8",
            //     "cities_id" => 1,
            //     "m_lat" => "-25.713120638463376",
            //     "m_lng" => "-53.766634706407785",
            //     "amount" => "16",
            //     "busy" => "16",
            //     "description" => "PON 5 NAP 8"
            // ],
            // [
            //     "name" => "PON 4 NAP 8",
            //     "cities_id" => 1,
            //     "m_lat" => "-25.720321919751417",
            //     "m_lng" => "-53.77175772562623",
            //     "amount" => "8",
            //     "busy" => "8",
            //     "description" => "PON 4 NAP 8"
            // ],
            // [
            //     "name" => "PON 6 NAP 5 NICO PEÇAS",
            //     "cities_id" => 4,
            //     "m_lat" => "-26.01657444210163",
            //     "m_lng" => "-53.73906960245222",
            //     "amount" => "8",
            //     "busy" => "7",
            //     "description" => "PON 6 NAP 5 NICO PEÇAS"
            // ],
            // [
            //     "name" => "PON 5 NAP1",
            //     "cities_id" => 4,
            //     "m_lat" => "-26.02147953059222",
            //     "m_lng" => "-53.74126369133592",
            //     "amount" => "26",
            //     "busy" => "16",
            //     "description" => "PON 5 NAP1"
            // ],
            // [
            //     "name" => "PON 5 NAP2",
            //     "cities_id" => 4,
            //     "m_lat" => "-26.02071063837682",
            //     "m_lng" => "-53.741558734327555",
            //     "amount" => "16",
            //     "busy" => "4",
            //     "description" => "PON 5 NAP2"
            // ],
            // [
            //     "name" => "PON 5 NAP3",
            //     "cities_id" => 4,
            //     "m_lat" => "-26.019375308891444",
            //     "m_lng" => "-53.74235535040498",
            //     "amount" => "22",
            //     "busy" => "9",
            //     "description" => "PON 5 NAP3"
            // ],
            // [
            //     "name" => "PON 5 NAP4",
            //     "cities_id" => 4,
            //     "m_lat" => "-26.018230384329662",
            //     "m_lng" => "-53.74303663149476",
            //     "amount" => "16",
            //     "busy" => "9",
            //     "description" => "PON 5 NAP4"
            // ],
            // [
            //     "name" => "PON 5 NAP5",
            //     "cities_id" => 4,
            //     "m_lat" => "-26.017331309424616",
            //     "m_lng" => "-53.74357307329774",
            //     "amount" => "16",
            //     "busy" => "12",
            //     "description" => "PON 5 NAP5"
            // ],
            // [
            //     "name" => "PON 5 NAP6",
            //     "cities_id" => 4,
            //     "m_lat" => "-26.016053791683277",
            //     "m_lng" => "-53.74371254816651",
            //     "amount" => "16",
            //     "busy" => "11",
            //     "description" => "PON 5 NAP6"
            // ],
            // [
            //     "name" => "PON 8 NAP1",
            //     "cities_id" => 4,
            //     "m_lat" => "-26.014409871039863",
            //     "m_lng" => "-53.74387348070741",
            //     "amount" => "20",
            //     "busy" => "19",
            //     "description" => "PON 8 NAP1"
            // ],
            // [
            //     "name" => "PON 4 NAP1",
            //     "cities_id" => 4,
            //     "m_lat" => "-26.01657444210163",
            //     "m_lng" => "-53.742052260786295",
            //     "amount" => "24",
            //     "busy" => "20",
            //     "description" => "PON 4 NAP1"
            // ],
            // [
            //     "name" => "PON 4 NAP2",
            //     "cities_id" => 4,
            //     "m_lat" => "-26.015882651458156",
            //     "m_lng" => "-53.740767440758646",
            //     "amount" => "18",
            //     "busy" => "10",
            //     "description" => "PON 4 NAP2"
            // ],
            // [
            //     "name" => "PON 4 NAP3",
            //     "cities_id" => 4,
            //     "m_lat" => "-26.015405385850325",
            //     "m_lng" => "-53.73979379888624",
            //     "amount" => "18",
            //     "busy" => "14",
            //     "description" => "PON 4 NAP3"
            // ],
            // [
            //     "name" => "PON 4 NAP4",
            //     "cities_id" => 4,
            //     "m_lat" => "-26.014296579473147",
            //     "m_lng" => "-53.73925203457475",
            //     "amount" => "16",
            //     "busy" => "15",
            //     "description" => "PON 4 NAP4"
            // ],
            // [
            //     "name" => "PON 4 NAP5",
            //     "cities_id" => 4,
            //     "m_lat" => "-26.013419168743773",
            //     "m_lng" => "-53.73894626274705",
            //     "amount" => "16",
            //     "busy" => "5",
            //     "description" => "PON 4 NAP5"
            // ],
            // [
            //     "name" => "PON 6 NAP1",
            //     "cities_id" => 4,
            //     "m_lat" => "-26.015492161559706",
            //     "m_lng" => "-53.73768826480955",
            //     "amount" => "24",
            //     "busy" => "15",
            //     "description" => "PON 6 NAP1"
            // ],
            // [
            //     "name" => "PON 6 NAP2",
            //     "cities_id" => 4,
            //     "m_lat" => "-26.014795543638854",
            //     "m_lng" => "-53.736886284314096",
            //     "amount" => "16",
            //     "busy" => "5",
            //     "description" => "PON 6 NAP2"
            // ],
            // [
            //     "name" => "PON 6 NAP3",
            //     "cities_id" => 4,
            //     "m_lat" => "-26.014156772708198",
            //     "m_lng" => "-53.736129901371896",
            //     "amount" => "16",
            //     "busy" => "12",
            //     "description" => "PON 6 NAP3"
            // ],
            // [
            //     "name" => "PON 3 NAP1",
            //     "cities_id" => 4,
            //     "m_lat" => "-26.025417915178824",
            //     "m_lng" => "-53.73868604656309",
            //     "amount" => "28",
            //     "busy" => "18",
            //     "description" => "PON 3 NAP1"
            // ],
            // [
            //     "name" => "PON 3 NAP2",
            //     "cities_id" => 4,
            //     "m_lat" => "-26.024894893747515",
            //     "m_lng" => "-53.73759438749403",
            //     "amount" => "18",
            //     "busy" => "12",
            //     "description" => "PON 3 NAP2"
            // ],
            // [
            //     "name" => "PON 3 NAP3",
            //     "cities_id" => 4,
            //     "m_lat" => "-26.024191100861422",
            //     "m_lng" => "-53.73615404125303",
            //     "amount" => "18",
            //     "busy" => "15",
            //     "description" => "PON 3 NAP3"
            // ],
            // [
            //     "name" => "PON 3 NAP4",
            //     "cities_id" => 4,
            //     "m_lat" => "-26.023417405866",
            //     "m_lng" => "-53.734906814061105",
            //     "amount" => "14",
            //     "busy" => "14",
            //     "description" => "PON 3 NAP4"
            // ],
            // [
            //     "name" => "PON 8 NAP5",
            //     "cities_id" => 4,
            //     "m_lat" => "-26.021747074978",
            //     "m_lng" => "-53.735888502560556",
            //     "amount" => "18",
            //     "busy" => "11",
            //     "description" => "PON 8 NAP5"
            // ],
            // [
            //     "name" => "PON 8 NAP6",
            //     "cities_id" => 4,
            //     "m_lat" => "-26.020628687185326",
            //     "m_lng" => "-53.736545643769205",
            //     "amount" => "16",
            //     "busy" => "3",
            //     "description" => "PON 8 NAP6"
            // ],
            // [
            //     "name" => "PON 8 NAP7",
            //     "cities_id" => 4,
            //     "m_lat" => "-26.01968142367158",
            //     "m_lng" => "-53.73712500091642",
            //     "amount" => "20",
            //     "busy" => "18",
            //     "description" => "PON 8 NAP7"
            // ],
            // [
            //     "name" => "PON 2.8 NAP0 6",
            //     "cities_id" => 5,
            //     "m_lat" => "-26.07878275897557",
            //     "m_lng" => "-53.721557459793985",
            //     "amount" => "8",
            //     "busy" => "6",
            //     "description" => "PON 2.8 NAP0 6"
            // ],
            // [
            //     "name" => "PON 1.4 NAP 1",
            //     "cities_id" => 5,
            //     "m_lat" => "-26.080895550833976",
            //     "m_lng" => "-53.7214885186404",
            //     "amount" => "8",
            //     "busy" => "6",
            //     "description" => "PON 1.4 NAP 1"
            // ],
            // [
            //     "name" => "PON 1.4 NAP 02",
            //     "cities_id" => 5,
            //     "m_lat" => "-26.082952896452223",
            //     "m_lng" => "-53.72141341678798",
            //     "amount" => "16",
            //     "busy" => "16",
            //     "description" => "PON 1.4 NAP 02"
            // ],
            // [
            //     "name" => "PON 1.2 NAP 03",
            //     "cities_id" => 5,
            //     "m_lat" => "-26.077267403590124",
            //     "m_lng" => "-53.73007167130709",
            //     "amount" => "10",
            //     "busy" => "10",
            //     "description" => "PON 1.2 NAP 03"
            // ],
            // [
            //     "name" => "PON 1.2 NAP 06",
            //     "cities_id" => 5,
            //     "m_lat" => "-26.07769141597641",
            //     "m_lng" => "-53.731310768052936",
            //     "amount" => "18",
            //     "busy" => "9",
            //     "description" => "PON 1.2 NAP 06"
            // ],
            // [
            //     "name" => "PON 1.2 NAP 07",
            //     "cities_id" => 5,
            //     "m_lat" => "-26.076489240499555",
            //     "m_lng" => "-53.7312866281718",
            //     "amount" => "16",
            //     "busy" => "13",
            //     "description" => "PON 1.2 NAP 07"
            // ],
            // [
            //     "name" => "PON 1.3 NAP 10",
            //     "cities_id" => 5,
            //     "m_lat" => "-26.0700686182411",
            //     "m_lng" => "-53.72272527398536",
            //     "amount" => "16",
            //     "busy" => "11",
            //     "description" => "PON 1.3 NAP 10"
            // ],
            // [
            //     "name" => "PON 2.2 NAP 08",
            //     "cities_id" => 5,
            //     "m_lat" => "-26.061187528084076",
            //     "m_lng" => "-53.72290392871946",
            //     "amount" => "8",
            //     "busy" => "7",
            //     "description" => "PON 2.2 NAP 08"
            // ],
            // [
            //     "name" => "PON 1.2 NAP 14",
            //     "cities_id" => 5,
            //     "m_lat" => "-26.081572503442494",
            //     "m_lng" => "-53.73108948580921",
            //     "amount" => "8",
            //     "busy" => "8",
            //     "description" => "PON 1.2 NAP 14"
            // ],
            // [
            //     "name" => "PON 1.2 NAP 08",
            //     "cities_id" => 5,
            //     "m_lat" => "-26.078637459020474",
            //     "m_lng" => "-53.732281624283424",
            //     "amount" => "10",
            //     "busy" => "9",
            //     "description" => "PON 1.2 NAP 08"
            // ],
            // [
            //     "name" => "PON 1.2 NAP 09",
            //     "cities_id" => 5,
            //     "m_lat" => "-26.077633596195977",
            //     "m_lng" => "-53.73270551674068",
            //     "amount" => "8",
            //     "busy" => "8",
            //     "description" => "PON 1.2 NAP 09"
            // ],
            // [
            //     "name" => "PON 1.2 NAP 11",
            //     "cities_id" => 5,
            //     "m_lat" => "-26.07958258888524",
            //     "m_lng" => "-53.73251964803785",
            //     "amount" => "10",
            //     "busy" => "10",
            //     "description" => "PON 1.2 NAP 11"
            // ],
            // [
            //     "name" => "PON 1.2 NAP 12",
            //     "cities_id" => 5,
            //     "m_lat" => "-26.080616095946457",
            //     "m_lng" => "-53.73246332164854",
            //     "amount" => "18",
            //     "busy" => "18",
            //     "description" => "PON 1.2 NAP 12"
            // ],
            // [
            //     "name" => "PON 2.6 NAP 06",
            //     "cities_id" => 5,
            //     "m_lat" => "-26.075253323783876",
            //     "m_lng" => "-53.73149852268398",
            //     "amount" => "8",
            //     "busy" => "7",
            //     "description" => "PON 2.6 NAP 06"
            // ],
            // [
            //     "name" => "PON 2.4 NAP 05",
            //     "cities_id" => 5,
            //     "m_lat" => "-26.06154172352695",
            //     "m_lng" => "-53.72796257492155",
            //     "amount" => "16",
            //     "busy" => "14",
            //     "description" => "PON 2.4 NAP 05"
            // ],
            // [
            //     "name" => "PON 2.2 NAP 09",
            //     "cities_id" => 5,
            //     "m_lat" => "-26.060296011005182",
            //     "m_lng" => "-53.72407068964094",
            //     "amount" => "16",
            //     "busy" => "9",
            //     "description" => "PON 2.2 NAP 09"
            // ],
            // [
            //     "name" => "PON 3.1 NAP 07",
            //     "cities_id" => 5,
            //     "m_lat" => "-26.082254270262048",
            //     "m_lng" => "-53.732356829568744",
            //     "amount" => "16",
            //     "busy" => "16",
            //     "description" => "PON 3.1 NAP 07"
            // ],
            // [
            //     "name" => "CX GARRAGEM",
            //     "cities_id" => 5,
            //     "m_lat" => "-26.075501471851524",
            //     "m_lng" => "-53.71578802820295",
            //     "amount" => "0",
            //     "busy" => "0",
            //     "description" => "CX GARRAGEM"
            // ],
            // [
            //     "name" => "PON 1.8 NAP 05",
            //     "cities_id" => 5,
            //     "m_lat" => "-26.057684067863455",
            //     "m_lng" => "-53.72074743267149",
            //     "amount" => "16",
            //     "busy" => "15",
            //     "description" => "PON 1.8 NAP 05"
            // ],
            // [
            //     "name" => "PON 1.8 NAP 06",
            //     "cities_id" => 5,
            //     "m_lat" => "-26.058563557065465",
            //     "m_lng" => "-53.720822534523904",
            //     "amount" => "16",
            //     "busy" => "5",
            //     "description" => "PON 1.8 NAP 06"
            // ],
            // [
            //     "name" => "PON 1.8 NAP 07",
            //     "cities_id" => 5,
            //     "m_lat" => "-26.057773221864053",
            //     "m_lng" => "-53.71953239198774",
            //     "amount" => "16",
            //     "busy" => "11",
            //     "description" => "PON 1.8 NAP 07"
            // ],
            // [
            //     "name" => "PON 1.8 NAP 08",
            //     "cities_id" => 5,
            //     "m_lat" => "-26.057599732935575",
            //     "m_lng" => "-53.71856679674238",
            //     "amount" => "16",
            //     "busy" => "12",
            //     "description" => "PON 1.8 NAP 08"
            // ],
            // [
            //     "name" => "PON 3.6 NAP 1",
            //     "cities_id" => 5,
            //     "m_lat" => "-26.06265249276678",
            //     "m_lng" => "-53.716338677331805",
            //     "amount" => "24",
            //     "busy" => "14",
            //     "description" => "PON 3.6 NAP 1"
            // ],
            // [
            //     "name" => "PON 3.6 NAP 3",
            //     "cities_id" => 5,
            //     "m_lat" => "-26.061703159189864",
            //     "m_lng" => "-53.715028963051736",
            //     "amount" => "16",
            //     "busy" => "4",
            //     "description" => "PON 3.6 NAP 3"
            // ],
            // [
            //     "name" => "PON 3.6 NAP 2",
            //     "cities_id" => 5,
            //     "m_lat" => "-26.0618164049699",
            //     "m_lng" => "-53.71645862236619",
            //     "amount" => "16",
            //     "busy" => "6",
            //     "description" => "PON 3.6 NAP 2"
            // ],
            // [
            //     "name" => "PON 3.6 NAP 4",
            //     "cities_id" => 5,
            //     "m_lat" => "-26.064343925912944",
            //     "m_lng" => "-53.716235999017954",
            //     "amount" => "16",
            //     "busy" => "14",
            //     "description" => "PON 3.6 NAP 4"
            // ],
            // [
            //     "name" => "PON 3.6 NAP 5",
            //     "cities_id" => 5,
            //     "m_lat" => "-26.066637682272187",
            //     "m_lng" => "-53.71603483334184",
            //     "amount" => "16",
            //     "busy" => "9",
            //     "description" => "PON 3.6 NAP 5"
            // ],
            // [
            //     "name" => "PON 3.6 NAP 6",
            //     "cities_id" => 5,
            //     "m_lat" => "-26.066172670169728",
            //     "m_lng" => "-53.71670538559556",
            //     "amount" => "16",
            //     "busy" => "8",
            //     "description" => "PON 3.6 NAP 6"
            // ]

        ]);
    }
}