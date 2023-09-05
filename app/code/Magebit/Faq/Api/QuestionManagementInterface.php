<?php

declare(strict_types=1);

namespace Magebit\Faq\Api;

use Magebit\Faq\Api\Data\QuestionInterface;

interface QuestionManagementInterface {
    /**
     * @param QuestionInterface $question
     * @return QuestionInterface
     */
    public function enableQuestion(QuestionInterface $question): QuestionInterface;

    /**
     * @param QuestionInterface $question
     * @return QuestionInterface
     */
    public function disableQuestion(QuestionInterface $question): QuestionInterface;

}
