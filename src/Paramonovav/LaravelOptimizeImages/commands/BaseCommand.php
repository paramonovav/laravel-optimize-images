<?php
namespace Paramonovav\LaravelOptimizeImages\Commands;
 
use Illuminate\Console\Command;
use Symfony\Component\Console\Formatter\OutputFormatter;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
 
 
class ParamonovavBaseCommand extends Command {
 
    public function run( InputInterface $input, OutputInterface $output )
    {
        // Set extra colors.
        // The most problem is $output->getFormatter() don't work...
        // So create new formatter to add extra color.
 
        $formatter = new OutputFormatter( $output->isDecorated() );

        $formatter->setStyle( 'red', new OutputFormatterStyle( 'red', 'black' ) );
        $formatter->setStyle( 'green', new OutputFormatterStyle( 'green', 'black' ) );
        $formatter->setStyle( 'yellow', new OutputFormatterStyle( 'yellow', 'black' ) );
        $formatter->setStyle( 'blue', new OutputFormatterStyle( 'blue', 'black' ) );
        $formatter->setStyle( 'magenta', new OutputFormatterStyle( 'magenta', 'black' ) );
        $formatter->setStyle( 'yellow-blue', new OutputFormatterStyle( 'yellow', 'blue' ) );

        $output->setFormatter( $formatter );
 
        return parent::run( $input, $output );
    }
}