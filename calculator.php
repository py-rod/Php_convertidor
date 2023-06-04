<?php


interface IssetCheck
{
    public function checkSelect($quantity, $select1, $select2);
}


abstract class Conversion
{
    abstract public function convert($quantity, $select1, $select2);
}


class Check implements IssetCheck
{
    public function checkSelect($quantity, $select1, $select2)
    {
        return isset($quantity) && isset($select1) && isset($select2);
    }
}

class Monedas extends Conversion
{

    public function symbols()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.apilayer.com/exchangerates_data/symbols",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: text/plain",
                "apikey: BfTLi2g4xtbZ0bsvflT79P1kMB4LKko2"
            ),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET"
        ));

        return curl_exec($curl);
        curl_close($curl);
    }


    public function mensaje()
    {
        return "mierda";
    }

    public function convert($quantity, $select1, $select2)
    {
        if ($quantity == null or $quantity == 0 or $select1 == $select2) {
            return "Nada que hacer";
        } else {
            $curl_convert = curl_init();
            curl_setopt_array($curl_convert, array(
                CURLOPT_URL => "https://api.apilayer.com/exchangerates_data/convert?to=$select2&from=$select1&amount=$quantity",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: text/plain",
                    "apikey: BfTLi2g4xtbZ0bsvflT79P1kMB4LKko2"
                ),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET"
            ));
            $response_convert = curl_exec($curl_convert);
            curl_close($curl_convert);
            $data = json_decode($response_convert);
            $result = $data->result;
            $result =  number_format($result, 2);
            return $result;
        }
    }
}


class Longitud extends Conversion
{

    public function data_array()
    {
        $operaciones = array(
            "metros" => array(
                'pulgadas' => '* 39.37',
                'pies' => '* 3.28084',
                'millas' => '* 0.0006214'
            ),
            "pulgadas" => array(
                'metros' => '/ 39.37',
                'pies' => '/ 12',
                'millas' => '/ 63360'
            ),
            "pies" => array(
                'metros' => '/ 3.28084',
                'pulgadas' => '* 12',
                'millas' => '/ 5280'
            ),
            "millas" => array(
                'metros' => '/ 0.0006214',
                'pulgadas' => '* 63360',
                'pies' => '* 5280'
            )
        );
        return $operaciones;
    }


    public function convert($quantity, $select1, $select2)
    {

        if ($quantity == null or $quantity == 0 or $select1 == $select2) {
            return "Nada que hacer";
        } else {
            $formula = $this->data_array()["$select1"]["$select2"];
            $conversion = $quantity . $formula;
            return eval("return $conversion;");
        }
    }
}

class Masa extends Conversion
{
    public function data_array()
    {
        $operaciones = array(
            "kilogramos" => array(
                'gramos' => '* 1000',
                'libras' => '* 2.20462',
                'onzas' => '* 35.274'
            ),
            "gramos" => array(
                'kilogramos' => '/ 1000',
                'libras' => '/ 453.592',
                'onzas' => '/ 28.3495'
            ),
            "libras" => array(
                'kilogramos' => '/ 2.20462',
                'gramos' => '* 453.592',
                'onzas' => '* 16'
            ),
            "onzas" => array(
                'kilogramos' => '/ 35.274',
                'gramos' => '* 28.3495',
                'libras' => '/ 16'
            )
        );
        return $operaciones;
    }

    public function convert($quantity, $select1, $select2)
    {
        if ($quantity == null or $quantity == 0 or $select1 == $select2) {
            return "Nada que hacer";
        } else {
            $formula = $this->data_array()["$select1"]["$select2"];
            $conversion = $quantity . $formula;
            return eval("return $conversion;");
        }
    }
}

class Datos extends Conversion
{
    public function data_array()
    {
        $operaciones = array(
            "bytes" => array(
                'kilobytes' => '/ 1024',
                'megabytes' => '/ 1048576',
                'gigabytes' => '/ 1073741824',
                'terabytes' => '/ 1099511627776'
            ),
            "kilobytes" => array(
                'bytes' => '* 1024',
                'megabytes' => '/ 1024',
                'gigabytes' => '/ 1048576',
                'terabytes' => '/ 1073741824'
            ),
            "megabytes" => array(
                'bytes' => '* 1048576',
                'kilobytes' => '* 1024',
                'gigabytes' => '/ 1024',
                'terabytes' => '/ 1048576'
            ),
            "gigabytes" => array(
                'bytes' => '* 1073741824',
                'kilobytes' => '* 1048576',
                'megabytes' => '* 1024',
                'terabytes' => '/ 1024'
            ),
            "terabytes" => array(
                'bytes' => '* 1099511627776',
                'kilobytes' => '* 1073741824',
                'megabytes' => '* 1048576',
                'gigabytes' => '* 1024'
            )
        );

        return $operaciones;
    }

    public function convert($quantity, $select1, $select2)
    {
        if ($quantity == null or $quantity == 0 or $select1 == $select2) {
            return "Nada que hacer";
        } else {
            $formula = $this->data_array()["$select1"]["$select2"];
            $conversion = $quantity . $formula;
            return eval("return $conversion;");
        }
    }
}


class Volumen extends Conversion
{

    public function data_array()
    {
        $operaciones = array(
            "litros" => array(
                'mililitros' => '* 1000',
                'galones' => '* 0.264172'
            ),
            "mililitros" => array(
                'litros' => '/ 1000',
                'galones' => '/ 3785.41'
            ),
            "galones" => array(
                'litros' => '* 3.78541',
                'mililitros' => '* 3785.41'
            )
        );
        return $operaciones;
    }

    public function convert($quantity, $select1, $select2)
    {
        if ($quantity == null or $quantity == 0 or $select1 == $select2) {
            return "Nada que hacer";
        } else {
            $formula = $this->data_array()["$select1"]["$select2"];
            $conversion = $quantity . $formula;
            return eval("return $conversion;");
        }
    }
}


class Tiempo extends Conversion
{
    public function data_array()
    {
        $operaciones = array(
            "milisegundos" => array(
                'nanosegundos' => '* 1000',
                'segundos' => '/ 1000',
                'microsegundos' => '* 1000',
                'minutos' => '/ 60000',
                'horas' => '/ 3600000',
                'dias' => '/ 86400000',
                'semanas' => '/ 604800000',
                'meses' => '/ 2628000000',
                'años' => '/ 31536000000'
            ),
            "nanosegundos" => array(
                'milisegundos' => '/ 1000',
                'segundos' => '/ 1000000000',
                'microsegundos' => '/ 1000',
                'minutos' => '/ 60000000000',
                'horas' => '/ 3600000000000',
                'dias' => '/ 86400000000000',
                'semanas' => '/ 604800000000000',
                'meses' => '/ 2628000000000000',
                'años' => '/ 31536000000000000'
            ),
            "segundos" => array(
                'milisegundos' => '* 1000',
                'nanosegundos' => '* 1000000000',
                'microsegundos' => '* 1000000',
                'minutos' => '/ 60',
                'horas' => '/ 3600',
                'dias' => '/ 86400',
                'semanas' => '/ 604800',
                'meses' => '/ 2628000',
                'años' => '/ 31536000'
            ),
            "microsegundos" => array(
                'milisegundos' => '/ 1000',
                'nanosegundos' => '* 1000',
                'segundos' => '/ 1000000',
                'minutos' => '/ 60000000',
                'horas' => '/ 3600000000',
                'dias' => '/ 86400000000',
                'semanas' => '/ 604800000000',
                'meses' => '/ 2628000000000',
                'años' => '/ 31536000000000'
            ),
            "minutos" => array(
                'milisegundos' => '* 60000',
                'nanosegundos' => '* 60000000000',
                'segundos' => '* 60',
                'microsegundos' => '* 60000000',
                'horas' => '/ 60',
                'dias' => '/ 1440',
                'semanas' => '/ 10080',
                'meses' => '/ 43800',
                'años' => '/ 525600'
            ),
            "horas" => array(
                'milisegundos' => '* 3600000',
                'nanosegundos' => '* 3600000000000',
                'segundos' => '* 3600',
                'microsegundos' => '* 3600000000',
                'minutos' => '* 60',
                'dias' => '/ 24',
                'semanas' => '/ 168',
                'meses' => '/ 730',
                'años' => '/ 8760'
            ),
            "dias" => array(
                'milisegundos' => '* 86400000',
                'nanosegundos' => '* 86400000000000',
                'segundos' => '* 86400',
                'microsegundos' => '* 86400000000',
                'minutos' => '* 1440',
                'horas' => '* 24',
                'semanas' => '/ 7',
                'meses' => '/ 30.417',
                'años' => '/ 365'
            ),
            "semanas" => array(
                'milisegundos' => '* 604800000',
                'nanosegundos' => '* 604800000000000',
                'segundos' => '* 604800',
                'microsegundos' => '* 604800000000',
                'minutos' => '* 10080',
                'horas' => '* 168',
                'dias' => '* 7',
                'meses' => '/ 4.345',
                'años' => '/ 52.143'
            ),
            "meses" => array(
                'milisegundos' => '* 2628000000',
                'nanosegundos' => '* 2628000000000000',
                'segundos' => '* 2628000',
                'microsegundos' => '* 2628000000000',
                'minutos' => '* 43800',
                'horas' => '* 730',
                'dias' => '* 30.417',
                'semanas' => '* 4.345',
                'años' => '/ 12'
            ),
            "años" => array(
                'milisegundos' => '* 31536000000',
                'nanosegundos' => '* 31536000000000000',
                'segundos' => '* 31536000',
                'microsegundos' => '* 31536000000000',
                'minutos' => '* 525600',
                'horas' => '* 8760',
                'dias' => '* 365',
                'semanas' => '* 52.143',
                'meses' => '* 12'
            )
        );

        return $operaciones;
    }

    public function convert($quantity, $select1, $select2)
    {
        if ($quantity == null or $quantity == 0 or $select1 == $select2) {
            return "Nada que hacer";
        } else {
            $formula = $this->data_array()["$select1"]["$select2"];
            $conversion = $quantity . $formula;
            return eval("return $conversion;");
        }
    }
}

class ConversionCalculator
{
    protected $conversionStrategy;

    public function setConversionStrategy(Conversion $strategy)
    {
        $this->conversionStrategy = $strategy;
    }

    public function convert($quantity, $select1, $select2)
    {
        if ($this->conversionStrategy) {
            return $this->conversionStrategy->convert($quantity, $select1, $select2);
        }
    }
}

$check = new Check();
$cal_convertion = new ConversionCalculator();

$html = file_get_contents('index.php');
// Buscar el valor de la etiqueta title 
if (preg_match('/<title[^>]*>(.*?)<\/title>/ims', $html, $matches)) {
    $title = $matches[1]; // Valor de la etiqueta title
    if ($title == "Monedas") {
        $confirmation_check = $check->checkSelect($_POST["quantity"], $_POST["select1"], $_POST["select2"]);
        $monedas = new Monedas();
        $response = $monedas->symbols();
        $cal_convertion->setConversionStrategy($monedas);
        if ($confirmation_check == true) {
            $result_monedas = $cal_convertion->convert($_POST["quantity"], $_POST["select1"], $_POST["select2"]);
        }
    }
}


$html2 = file_get_contents('longitud.php');
if (preg_match('/<title[^>]*>(.*?)<\/title>/ims', $html2, $matches2)) {
    $title2 = $matches2[1]; // Valor de la etiqueta title
    if ($title2 == "Longitud") {
        $confirmation_check = $check->checkSelect($_POST["quantity"], $_POST["select1"], $_POST["select2"]);
        $longitud = new Longitud();
        $cal_convertion->setConversionStrategy($longitud);
        if ($confirmation_check) {
            $result = $cal_convertion->convert($_POST["quantity"], $_POST["select1"], $_POST["select2"]);
        }
    }
}


$html3 = file_get_contents('masa.php');
if (preg_match('/<title[^>]*>(.*?)<\/title>/ims', $html3, $matches3)) {
    $title3 = $matches3[1]; // Valor de la etiqueta title
    if ($title3 == "Masa") {
        $confirmation_check = $check->checkSelect($_POST["quantity"], $_POST["select1"], $_POST["select2"]);
        $masa = new Masa();
        $cal_convertion->setConversionStrategy($masa);
        if ($confirmation_check) {
            $result = $cal_convertion->convert($_POST["quantity"], $_POST["select1"], $_POST["select2"]);
        }
    }
}


$html4 = file_get_contents('datos.php');
if (preg_match('/<title[^>]*>(.*?)<\/title>/ims', $html4, $matches4)) {
    $title4 = $matches4[1]; // Valor de la etiqueta title
    if ($title4 == "Datos") {
        $confirmation_check = $check->checkSelect($_POST["quantity"], $_POST["select1"], $_POST["select2"]);
        $datos = new Datos();
        $cal_convertion->setConversionStrategy($datos);
        if ($confirmation_check) {
            $result = $cal_convertion->convert($_POST["quantity"], $_POST["select1"], $_POST["select2"]);
        }
    }
}



$html5 = file_get_contents('volumen.php');
if (preg_match('/<title[^>]*>(.*?)<\/title>/ims', $html5, $matches5)) {
    $title5 = $matches5[1]; // Valor de la etiqueta title
    if ($title5 == "Volumen") {
        $confirmation_check = $check->checkSelect($_POST["quantity"], $_POST["select1"], $_POST["select2"]);
        $volumen = new Volumen();
        $cal_convertion->setConversionStrategy($volumen);
        if ($confirmation_check) {
            $result = $cal_convertion->convert($_POST["quantity"], $_POST["select1"], $_POST["select2"]);
        }
    }
}


$html6 = file_get_contents('tiempo.php');
if (preg_match('/<title[^>]*>(.*?)<\/title>/ims', $html6, $matches6)) {
    $title6 = $matches6[1]; // Valor de la etiqueta title
    if ($title6 == "Tiempo") {
        $confirmation_check = $check->checkSelect($_POST["quantity"], $_POST["select1"], $_POST["select2"]);
        $tiempo = new Tiempo();
        $cal_convertion->setConversionStrategy($tiempo);
        if ($confirmation_check) {
            $result = $cal_convertion->convert($_POST["quantity"], $_POST["select1"], $_POST["select2"]);
        }
    }
}
