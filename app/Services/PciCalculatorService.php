<?php

namespace App\Services;

class PciCalculatorService
{
    /**
     * Calcula qué medidas PCI son necesarias y cuáles no, en base a las reglas internas.
     *
     * @param array $inputs ['tipo' => 'B', 'uso' => 'almacén', 'superficie' => 1200, 'riesgo' => 'bajo']
     * @return array ['necesarias' => [...], 'omitidas' => [...]]
     */
    public function calculateWithJustification(array $inputs): array
    {
        $tipo = ($inputs['tipo'] ?? '');
        $superficie = (float) ($inputs['superficie'] ?? 0);
        $uso = strtolower($inputs['uso'] ?? '');
        $nivel = (int) ($inputs['nivel'] ?? 1); 
        $rasante = strtolower($inputs['rasante'] ?? 'rasante'); // opcional pero por defecto será "rasante"

        // 1. Riesgo textual
        $riesgo = match (true) {
            $nivel <= 3 => 'BAJO',
            $nivel <= 5 => 'MEDIO',
            default     => 'ALTO'
        };


        // 2. Superficie máxima permitida
        $superficieMax = $this->superficieMax($tipo, $nivel, $riesgo);

        // 3. Resistencia al fuego
        $resistencia = $this->resistenciaEF($tipo, $riesgo, $rasante);

        // 4. Resistencia ligera
        $resistenciaLigera = $this->resistenciaEFL($tipo, $riesgo);

        // 5. Detectores
        $usoDetectores = $this->usoDetectores($uso, $tipo, $nivel, $riesgo, $superficie);

        // 6. Pulsadores
        $usoPulsadores = $this->usoPulsadores($usoDetectores, $superficie);

        // 7.1 Hidrantes Camiones
        $usoHidrantesC = $this->usoHidrantesC($tipo, $superficie, $riesgo);

        // 7.2 Hidrantes Directos
        $usoHidrantesD = $this->usoHidrantesD($tipo, $superficie, $riesgo);

        // 8. Extintores (1 por cada 200 m²)
        $cantidadExtintores = $this->usoExtintores($superficie, $riesgo);

        // 9. BIEs
        $usoBIEs = $this->usoBies($tipo, $riesgo, $superficie);

        // 10. Rociadores
        $usoRociadores = $this->usoRociadores($uso, $tipo, $riesgo, $superficie);

        // 11. Control de humos
        $usoControlHumos = $this->usoControlH($uso, $riesgo, $superficie);

        return [
            'Tipo' => $tipo,
            'Uso' => ucfirst($uso),
            'Superficie' => $superficie,
            'Nivel' => $nivel,
            'Riesgo' => $riesgo,
            'Superficie_max.' => $superficieMax,
            'EF' => $resistencia,
            'EFL' => $resistenciaLigera,
            'DET.' => $usoDetectores ? 'Sí' : 'No',
            'PULSAD.' => $usoPulsadores ? 'Sí' : 'No',
            'HIDRA. CAM' => $usoHidrantesC ? 'Sí' : 'No',
            'HIDRA. DIR' => $usoHidrantesD ? 'Sí' : 'No',
            'EXTIN.' => $cantidadExtintores,
            'BIES' => $usoBIEs ? 'Sí' : 'No',
            'ROCI.' => $usoRociadores ? 'Sí' : 'No',
            'C.HUMOS' => $usoControlHumos ? 'Sí' : 'No',
        ];
    }


    private function superficieMax(string $tipo, int $nivel, string $riesgo): string|int
    {
        // Se puede extraer esto de un JSON o tabla legal real de la bd
        return match ([$tipo, $nivel, $riesgo]) {
            ['Av', 1, 'BAJO'] => 2000,
            ['Av', 2, 'BAJO'] => 1000,
            ['Av', 3, 'MEDIO'] => 500,
            ['Av', 4, 'MEDIO'] => 400,
            ['Av', 5, 'MEDIO'] => 300,
            ['Av', 6, 'ALTO'] => "No admitido",
            ['Av', 7, 'ALTO'] => "No admitido",
            ['Av', 8, 'ALTO'] => "No admitido",
            ['Ah', 1, 'BAJO'] => 6000,
            ['Ah', 2, 'BAJO'] => 4000,
            ['Ah', 3, 'MEDIO'] => 3500,
            ['Ah', 4, 'MEDIO'] => 3000,
            ['Ah', 5, 'MEDIO'] => 2500,
            ['Ah', 6, 'ALTO'] => 2000,
            ['Ah', 7, 'ALTO'] => 1500,
            ['Ah', 8, 'ALTO'] => "No admitido",
            ['B', 1, 'BAJO'] => 12000,
            ['B', 2, 'BAJO'] => 8000,
            ['B', 3, 'MEDIO'] => 7000,
            ['B', 4, 'MEDIO'] => 6000,
            ['B', 5, 'MEDIO'] => 5000,
            ['B', 6, 'ALTO'] => 4000,
            ['B', 7, 'ALTO'] => 3000,
            ['B', 8, 'ALTO'] => "No admitido",
            ['C', 1, 'BAJO'] => "Sin límite",
            ['C', 2, 'BAJO'] => 12000,
            ['C', 3, 'MEDIO'] => 10000,
            ['C', 4, 'MEDIO'] => 8000,
            ['C', 5, 'MEDIO'] => 7000,
            ['C', 6, 'ALTO'] => 6000,
            ['C', 7, 'ALTO'] => 5000,
            ['C', 8, 'ALTO'] => 4000,
            default => 800,
        };
    }

    private function resistenciaEF(string $tipo, string $riesgo, string $rasante): string
    {
        // Tipo Av y en Sotano
        if ($tipo === 'Av' && $rasante === 'sotano') {
            return match ($riesgo) {
                'BAJO' => 'EI 120',
                'MEDIO' => 'No admitido',
                'ALTO' => 'No admitido',
            };
        }
        // Tipo Av y en Rasante
        if ($tipo === 'Av' && $rasante === 'rasante') {
            return match ($riesgo) {
                'BAJO' => 'EI 90',
                'MEDIO' => 'EI 120',
                'ALTO' => 'No admitido',
            };
        }

        // Tipo Ah y en Sotano
        if ($tipo === 'Ah' && $rasante === 'sotano') {
            return match ($riesgo) {
                'BAJO' => 'EI 120',
                'MEDIO' => 'EI 180',
                'ALTO' => 'No admitido',
            };
        }
        // Tipo Ah y en Rasante
        if ($tipo === 'Ah' && $rasante === 'rasante') {
            return match ($riesgo) {
                'BAJO' => 'EI 90',
                'MEDIO' => 'EI 120',
                'ALTO' => 'EI 180',
            };
        }

        // Tipo B y en Sotano
        if ($tipo === 'B' && $rasante === 'sotano') {
            return match ($riesgo) {
                'BAJO' => 'EI 90',
                'MEDIO' => 'EI 120',
                'ALTO' => 'EI 180',
            };
        }
        // Tipo B y en Rasante
        if ($tipo === 'B' && $rasante === 'rasante') {
            return match ($riesgo) {
                'BAJO' => 'EI 60',
                'MEDIO' => 'EI 90',
                'ALTO' => 'EI 120',
            };
        }

        // Tipo C y en Sotano
        if ($tipo === 'C' && $rasante === 'sotano') {
            return match ($riesgo) {
                'BAJO' => 'EI 60',
                'MEDIO' => 'EI 90',
                'ALTO' => 'EI 120',
            };
        }
        // Tipo C y en Rasante
        if ($tipo === 'C' && $rasante === 'rasante') {
            return match ($riesgo) {
                'BAJO' => 'EI 30',
                'MEDIO' => 'EI 60',
                'ALTO' => 'EI 90',
            };
        }
        return 'Desconocido';
    }

    private function resistenciaEFL(string $tipo, string $riesgo): string
    {
        return match ([$tipo, $riesgo]) {
            ['Ah', 'BAJO'] => 'EI 60',
            ['Ah', 'MEDIO'] => 'EI 90',
            ['Ah', 'ALTO'] => 'EI 120',
            ['B', 'BAJO'] => 'EI 30',
            ['B', 'MEDIO'] => 'EI 30',
            ['B', 'ALTO'] => 'EI 30',
            ['C', 'BAJO'] => 'EI 30',
            ['C', 'MEDIO'] => 'EI 30',
            ['C', 'ALTO'] => 'EI 30',
            default => 'No Admitido',
        };
    }

    //La lógica de detectores se ajusta al BOE correctamente
    private function usoDetectores(string $uso, string $tipo, int $nivel, string $riesgo, float $superficie): string
    {
        $uso = strtolower($uso);

        return match (true) {
            // Producción
            $uso === 'producción' && in_array($tipo, ['Av', 'Ah']) && $superficie >= 300 => true,
            $uso === 'producción' && $tipo === 'B' && $riesgo === 'BAJO' && $nivel === 2 && $superficie >= 3000 => true,
            $uso === 'producción' && $tipo === 'B' && $riesgo === 'MEDIO' && $superficie >= 2000 => true,
            $uso === 'producción' && $tipo === 'B' && $riesgo === 'ALTO' && $superficie >= 1000 => true,
            $uso === 'producción' && $tipo === 'C' && $riesgo === 'BAJO' && $nivel === 2 && $superficie >= 4000 => true,
            $uso === 'producción' && $tipo === 'C' && $riesgo === 'MEDIO' && $superficie >= 3000 => true,
            $uso === 'producción' && $tipo === 'C' && $riesgo === 'ALTO' && $superficie >= 2000 => true,
            // Almacenamiento
            $uso === 'almacenamiento' && in_array($tipo, ['Av', 'Ah']) && $superficie >= 150 => true,
            $uso === 'almacenamiento' && $tipo === 'B' && $riesgo === 'BAJO' && $nivel === 2 && $superficie >= 1500 => true,
            $uso === 'almacenamiento' && $tipo === 'B' && $riesgo === 'MEDIO' && $superficie >= 1000 => true,
            $uso === 'almacenamiento' && $tipo === 'B' && $riesgo === 'ALTO' && $superficie >= 500 => true,
            $uso === 'almacenamiento' && $tipo === 'C' && $riesgo === 'BAJO' && $nivel === 2 && $superficie >= 3000 => true,
            $uso === 'almacenamiento' && $tipo === 'C' && $riesgo === 'MEDIO' && $superficie >= 1500 => true,
            $uso === 'almacenamiento' && $tipo === 'C' && $riesgo === 'ALTO' && $superficie >= 800 => true,
            default => false
        };
    }

    private function usoPulsadores(bool $usaDetectores, float $superficie): bool
    {
        return $usaDetectores || $superficie >= 400;
        //Si no hay detectores y la superficie es mayor o igual de 400 entonces si necesitan detectores
    }

    private function usoHidrantesC(string $tipo, float $superficie, string $riesgo): string
    {
        
        $riesgo = strtoupper(trim($riesgo));
        return match (true) {
            // Tipo Av
            $tipo === 'Av' && $superficie >= 1000 && $riesgo === 'BAJO' => true,
            $tipo === 'Av' && $superficie >= 300 && $riesgo === 'BAJO' => false,
            $tipo === 'Av' && $superficie >= 1000 && $riesgo === 'MEDIO' => true,
            $tipo === 'Av' && $superficie >= 300 && $riesgo === 'MEDIO' => true,
            $tipo === 'Av' && $superficie >= 1000 && $riesgo === 'ALTO' => false,
            $tipo === 'Av' && $superficie >= 300 && $riesgo === 'ALTO' => false,


            // Tipo Ah
            $tipo === 'Ah' && $superficie >= 1000 && $riesgo === 'BAJO' => true,
            $tipo === 'Ah' && $superficie >= 600 && $riesgo === 'BAJO' => false,
            $tipo === 'Ah' && $superficie >= 1000 && $riesgo === 'MEDIO' => true,
            $tipo === 'Ah' && $superficie >= 600 && $riesgo === 'MEDIO' => true,
            $tipo === 'Ah' && $superficie >= 1000 && $riesgo === 'ALTO' => true,
            $tipo === 'Ah' && $superficie >= 600 && $riesgo === 'ALTO' => true,

            // Tipo B
            $tipo === 'B' && $superficie >= 3500 && $riesgo === 'BAJO' => true,
            $tipo === 'B' && $superficie >= 2500 && $riesgo === 'BAJO' => false,
            $tipo === 'B' && $superficie >= 1000 && $riesgo === 'BAJO' => false,
            $tipo === 'B' && $superficie >= 3500 && $riesgo === 'MEDIO' => true,
            $tipo === 'B' && $superficie >= 2500 && $riesgo === 'MEDIO' => true,
            $tipo === 'B' && $superficie >= 1000 && $riesgo === 'MEDIO' => false,
            $tipo === 'B' && $superficie >= 3500 && $riesgo === 'ALTO' => true,
            $tipo === 'B' && $superficie >= 2500 && $riesgo === 'ALTO' => true,
            $tipo === 'B' && $superficie >= 1000 && $riesgo === 'ALTO' => true,

            // Tipo C
            $tipo === 'C' && $superficie >= 5000 && $riesgo === 'BAJO' => true,
            $tipo === 'C' && $superficie >= 3500 && $riesgo === 'BAJO' => false,
            $tipo === 'C' && $superficie >= 2500 && $riesgo === 'BAJO' => false,
            $tipo === 'C' && $superficie >= 5000 && $riesgo === 'MEDIO' => true,
            $tipo === 'C' && $superficie >= 3500 && $riesgo === 'MEDIO' => true,
            $tipo === 'C' && $superficie >= 2500 && $riesgo === 'MEDIO' => false,
            $tipo === 'C' && $superficie >= 5000 && $riesgo === 'ALTO' => true,
            $tipo === 'C' && $superficie >= 3500 && $riesgo === 'ALTO' => true,
            $tipo === 'C' && $superficie >= 2500 && $riesgo === 'ALTO' => true,

            // Tipo D
            $tipo === 'D' && $superficie >= 5000 && in_array($riesgo, ['BAJO', 'MEDIO', 'ALTO']) => true,

            default => false,
        };
    }

    private function usoHidrantesD(string $tipo, float $superficie, string $riesgo): string
    {

        return match (true) {
            // Tipo Ah
            $tipo === 'Ah' && $superficie >= 3500 && $riesgo === 'MEDIO' => true,
            $tipo === 'Ah' && $superficie >= 2500 && $riesgo === 'MEDIO' => false,
            $tipo === 'Ah' && $superficie >= 3500 && $riesgo === 'ALTO' => true,
            $tipo === 'Ah' && $superficie >= 2500 && $riesgo === 'ALTO' => true,

            // Tipo B
            $tipo === 'B' && $superficie >= 3500 && $riesgo === 'MEDIO' => true,
            $tipo === 'B' && $superficie >= 2500 && $riesgo === 'MEDIO' => false,
            $tipo === 'B' && $superficie >= 3500 && $riesgo === 'ALTO' => true,
            $tipo === 'B' && $superficie >= 2500 && $riesgo === 'ALTO' => true,

            // Tipo C
            $tipo === 'C' && $superficie >= 3500 && $riesgo === 'MEDIO' => true,
            $tipo === 'C' && $superficie >= 2500 && $riesgo === 'MEDIO' => false,
            $tipo === 'C' && $superficie >= 3500 && $riesgo === 'ALTO' => true,
            $tipo === 'C' && $superficie >= 2500 && $riesgo === 'ALTO' => true,

            // Tipo D
            $tipo === 'D' && $superficie >= 10000 && $riesgo === 'MEDIO' => true,
            $tipo === 'D' && $superficie >= 10000 && $riesgo === 'ALTO' => true,
            
            default => false,
        };
    }

    private function usoExtintores(float $superficie, string $riesgo): int
    {
        //((1+($superficie-600)/200));
        $riesgo = strtoupper($riesgo);

        // Define los m2 de referencia según el riesgo
        $limite = match ($riesgo) {
            'BAJO' => 600,
            'MEDIO' => 400,
            'ALTO' => 300,
            default => 600,
        };

        if ($superficie <= $limite) {
            return 1;
        }

        return (int) ceil(1 + (($superficie - $limite) / 200));
    }

    private function usoBies(string $tipo, string $riesgo, float $superficie): string
    {
        return match (true) {
            // Tipo Av
            $tipo === 'Av' && $superficie >= 300 => true,
            // Tipo Ah 
            $tipo === 'Ah' && $superficie >= 500 && $riesgo === 'MEDIO' => true,
            $tipo === 'Ah' && $superficie >= 500 && $riesgo === 'ALTO' => true,
            // Tipo B
            $tipo === 'B' && $superficie >= 200 && $riesgo === 'MEDIO' => true,
            $tipo === 'B' && $superficie >= 200 && $riesgo === 'ALTO' => true,
            // Tipo C
            $tipo === 'C' && $superficie >= 1000 && $riesgo === 'MEDIO' => true,
            $tipo === 'C' && $superficie >= 500 && $riesgo === 'ALTO' => true,
            // Tipo D
            $tipo === 'D' && $superficie >= 5000 && $riesgo === 'ALTO' => true,

            default => false
        };
    }

    private function usoRociadores(string $uso, string $tipo, string $riesgo, float $superficie): string
    {
        $uso = strtolower($uso);

        return match (true) {
            // Producción
            $uso === 'producción' && $tipo === 'Av' && $riesgo === 'MEDIO' && $superficie >= 500 => true,
            $uso === 'producción' && $tipo === 'Ah' && $riesgo === 'MEDIO' && $superficie >= 1500 => true,
            $uso === 'producción' && $tipo === 'Ah' && $riesgo === 'ALTO' && $superficie >= 750 => true,
            $uso === 'producción' && $tipo === 'B' && $riesgo === 'MEDIO' && $superficie >= 2500 => true,
            $uso === 'producción' && $tipo === 'B' && $riesgo === 'ALTO' && $superficie >= 1000 => true,
            $uso === 'producción' && $tipo === 'C' && $riesgo === 'MEDIO' && $superficie >= 3500 => true,
            $uso === 'producción' && $tipo === 'C' && $riesgo === 'ALTO' && $superficie >= 2000 => true,
            // Almacenamiento
            $uso === 'almacenamiento' && $tipo === 'Av' && $riesgo === 'MEDIO' && $superficie >= 300 => true,
            $uso === 'almacenamiento' && $tipo === 'Ah' && $riesgo === 'MEDIO' && $superficie >= 1000 => true,
            $uso === 'almacenamiento' && $tipo === 'Ah' && $riesgo === 'ALTO' && $superficie >= 600 => true,
            $uso === 'almacenamiento' && $tipo === 'B' && $riesgo === 'MEDIO' && $superficie >= 1500 => true,
            $uso === 'almacenamiento' && $tipo === 'B' && $riesgo === 'ALTO' && $superficie >= 800 => true,
            $uso === 'almacenamiento' && $tipo === 'C' && $riesgo === 'MEDIO' && $superficie >= 2000 => true,
            $uso === 'almacenamiento' && $tipo === 'C' && $riesgo === 'ALTO' && $superficie >= 1000 => true,
            default => false
        };
    }

    private function usoControlH(string $uso, string $riesgo, float $superficie): string
    {
        $uso = strtolower($uso);

        return match (true) {
            // Producción
            $uso === 'producción' && $riesgo === 'MEDIO' && $superficie >= 2000 => true,
            $uso === 'producción' && $riesgo === 'ALTO' && $superficie >= 1000 => true,

            // Almacenamiento
            $uso === 'almacenamiento' && $riesgo === 'MEDIO' && $superficie >= 1000 => true,
            $uso === 'almacenamiento' && $riesgo === 'ALTO' && $superficie >= 800 => true,

            default => false
        };
    }
}
