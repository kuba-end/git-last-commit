<?php

namespace KubaEnd\Common\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

abstract class AbstractCommand extends Command
{
    /**
     * Command input interface.
     *
     * @var InputInterface
     */
    protected InputInterface $input;

    /**
     * Command output interface.
     *
     * @var OutputInterface
     */
    protected OutputInterface $output;

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->input = $input;
        $this->output = $output;

        return $this->handle();
    }

    abstract public function handle(): int;

    /**
     * Ask choice question to user.
     *
     * @param string $question
     * @param array  $choices
     * @param null   $default
     *
     * @return string|int|bool|mixed|null
     */
    protected function askChoiceQuestion(string $question, array $choices, $default = null)
    {
        $question = new ChoiceQuestion($question, $choices, $default);

        return $this->createQuestionHelper()->ask(
            $this->input,
            $this->output,
            $question
        );
    }

    protected function askQuestion(string $question): string
    {
        return $this->createQuestionHelper()->ask(
            $this->input,
            $this->output,
            new Question($question)
        );
    }

    protected function createQuestionHelper()
    {
        return $this->getHelper('question');
    }

    protected function writeLine(string $line): void
    {
        $this->output->writeln($line);
    }
}
