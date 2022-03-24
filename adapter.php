<!-- Exemplos de uso: O padrão Adapter é bastante comum no código PHP. É frequentemente usado em sistemas baseados em algum código legado. Nesses casos, os adaptadores criam código legado com classes modernas.

Identificação: O adapter é reconhecível por um construtor que utiliza uma instância de tipo abstrato/interface diferente. Quando o adaptador recebe uma chamada para qualquer um de seus métodos, ele converte parâmetros para o formato apropriado e direciona a chamada para um ou vários métodos do objeto envolvido. -->

<?php

namespace RefactoringGuru\Adapter\Conceptual;

/**
 * O Destino define a interface específica do domínio usada pelo código do cliente.
 */
class Target
{
    public function request(): string
    {
        return "Target: The default target's behavior.";
    }
}

/**
 * O Adaptee contém alguns comportamentos úteis, mas sua interface é incompatível
 * com o código do cliente existente. O Adaptado precisa de alguma adaptação antes do
 * o código do cliente pode usá-lo.
 */
class Adaptee
{
    public function specificRequest(): string
    {
        return ".eetpadA eht fo roivaheb laicepS";
    }
}

/**
 * O Adapter torna a interface do Adaptee compatível com a do Target
 * interface.
 */
class Adapter extends Target
{
    private $adaptee;

    public function __construct(Adaptee $adaptee)
    {
        $this->adaptee = $adaptee;
    }

    public function request(): string
    {
        return "Adapter: (TRANSLATED) " . strrev($this->adaptee->specificRequest());
    }
}

/**
 * O código cliente suporta todas as classes que seguem a interface Target.
 */
function clientCode(Target $target)
{
    echo $target->request();
}

echo "Client: I can work just fine with the Target objects:\n";
$target = new Target();
clientCode($target);
echo "\n\n";

$adaptee = new Adaptee();
echo "Client: The Adaptee class has a weird interface. See, I don't understand it:\n";
echo "Adaptee: " . $adaptee->specificRequest();
echo "\n\n";

echo "Client: But I can work with it via the Adapter:\n";
$adapter = new Adapter($adaptee);
clientCode($adapter);
